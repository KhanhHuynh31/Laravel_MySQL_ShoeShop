<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Cart;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;
use PDF;

session_start();

class CheckoutController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function login_checkout()
    {
        return view('pages.checkout.login_checkout');
    }
    public function add_customer(Request $request)
    {

        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_address'] = $request->customer_address;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $customer_id = DB::table('tbl_customer')->insertGetId($data);
        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $request->customer_name);
        return Redirect::to('/show-cart');
    }
    public function checkout()
    {
        $customer_id = Session::get('customer_id');
        $customer = DB::table('tbl_customer')->where('customer_id', $customer_id)->first();
        $city = City::orderby('matp', 'ASC')->get();
        return view('pages.checkout.show_checkout')->with('customer', $customer)->with('city', $city);
    }
    public function save_checkout_customer(Request $request)
    {
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_notes'] = $request->shipping_notes;
        $data['shipping_address'] = $request->shipping_address;

        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);

        Session::put('shipping_id', $shipping_id);

        return Redirect::to('/payment');
    }
    public function payment()
    {

        return view('pages.checkout.payment');
    }
    public function del_order(Request $request, $order_code)
    {
        $order = DB::table('tbl_order')->where('order_id', $order_code)->delete();
        Session::put('message', 'Xóa đơn hàng thành công');
        return redirect()->back();
    }
    public function update_order(Request $request, $orderId)
    {
        $this->AuthLogin();
        $data = array();
        $data['order_status'] = $request->order_status;
        if ($data['order_status'] == 1) {
            $orderdetails = DB::table('tbl_order_details')->join('tbl_product', 'tbl_product.product_id', '=', 'tbl_order_details.product_id')->where('tbl_order_details.order_id', $orderId)->get();
            foreach ($orderdetails as $key => $ord) {
                $product_id = $ord->product_id;
                $product_qty = $ord->product_quantity;
                $product_count = $ord->product_count;
                DB::table('tbl_product')->where('product_id', $product_id)->update(['product_count' => $product_count - $product_qty]);
            }
        }

        DB::table('tbl_order')->where('order_id', $orderId)->update($data);
        Session::put('message', 'Cập nhật hoá đơn thành công');
        return redirect()->back();
    }
    public function view_order($orderId)
    {
        $getorder = DB::table('tbl_order')->where('order_id', $orderId)->get();
        foreach ($getorder as $key => $ord) {
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
            $order_status = $ord->order_status;
        }
        $customer = DB::table('tbl_customer')->where('customer_id', $customer_id)->first();
        $shipping = DB::table('tbl_shipping')->where('shipping_id', $shipping_id)->first();
        $order_details_product = DB::table('tbl_order_details')->join('tbl_product', 'tbl_product.product_id', '=', 'tbl_order_details.product_id')->where('order_id', $orderId)->get();
        return view('admin.view_order')->with('order_details_product', $order_details_product)->with('order_status', $order_status)->with('customer', $customer)->with('shipping', $shipping)->with('getorder', $getorder);
    }
    public function order_place(Request $request)
    {
        //insert payment_method

        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lý';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);

        //insert order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::totalFloat() / 1.21;
        $order_data['coupon_total'] = Session::get('total_coupon', 0);
        $order_data['order_fee'] = Session::get('fee', 0);
        $date_now = date('Y-m-d H:i:s');
        $order_data['order_date'] = $date_now;
        $order_data['order_status'] = 'Đang chờ xử lý';
        $order_id = DB::table('tbl_order')->insertGetId($order_data);

        //insert order_details
        $content = Cart::content();
        foreach ($content as $v_content) {
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_price'] = $v_content->price;
            $order_d_data['product_quantity'] = $v_content->qty;
            DB::table('tbl_order_details')->insert($order_d_data);
        }
        if ($data['payment_method'] == 1) {

            echo 'Thanh toán thẻ ATM';
        } elseif ($data['payment_method'] == 2) {
            Cart::destroy();
            Session::forget('fee');
            Session::forget('total_coupon');
            $cate_product = DB::table('tbl_category')->where('category_status', '0')->orderby('category_id', 'desc')->get();
            $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();
            return view('pages.checkout.thankyou')->with('category', $cate_product)->with('brand', $brand_product);
        } else {
            echo 'Thẻ ghi nợ';
        }
    }
    public function select_delivery_home(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == "city") {
                $select_province = Province::where('matp', $data['ma_id'])->orderby('maqh', 'ASC')->get();
                $output .= '<option>---Chọn quận huyện---</option>';
                foreach ($select_province as $key => $province) {
                    $output .= '<option value="' . $province->maqh . '">' . $province->name_quanhuyen . '</option>';
                }
            } else {
                $select_wards = Wards::where('maqh', $data['ma_id'])->orderby('xaid', 'ASC')->get();
                $output .= '<option>---Chọn xã phường---</option>';
                foreach ($select_wards as $key => $ward) {
                    $output .= '<option value="' . $ward->xaid . '">' . $ward->name_xaphuong . '</option>';
                }
            }
            echo $output;
        }
    }
    public function calculate_fee(Request $request)
    {
        $data = $request->all();
        if ($data['matp']) {
            $feeship = Feeship::where('fee_matp', $data['matp'])->where('fee_maqh', $data['maqh'])->where('fee_xaph', $data['xaid'])->get();
            if ($feeship) {
                $count_feeship = $feeship->count();
                if ($count_feeship > 0) {
                    foreach ($feeship as $key => $fee) {
                        Session::put('fee', $fee->fee_feeship);
                        Session::save();
                    }
                } else {
                    Session::put('fee', 25000);
                    Session::save();
                }
            }
        }
    }
    public function logout_checkout()
    {
        Session::flush();
        return Redirect::to('/login-checkout');
    }
    public function login_customer(Request $request)
    {
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('tbl_customer')->where('customer_email', $email)->where('customer_password', $password)->first();


        if ($result) {
            Session::put('customer_id', $result->customer_id);
            return Redirect::to('/show-cart');
        } else {
            return Redirect::to('/login-checkout');
        }
    }
    public function manage_order()
    {

        $this->AuthLogin();
        $all_order = DB::table('tbl_order')
            ->join('tbl_customer', 'tbl_order.customer_id', '=', 'tbl_customer.customer_id')
            ->select('tbl_order.*', 'tbl_customer.customer_name')
            ->orderby('tbl_order.order_id', 'desc')->get();
        $manager_order  = view('admin.manage_order')->with('all_order', $all_order);
        return view('admin_layout')->with('admin.manage_order', $manager_order);
    }
    public function print_order($order_id)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($order_id));

        return $pdf->stream();
    }
    public function print_order_convert($order_id)
    {
        $getorder = DB::table('tbl_order')->where('order_id', $order_id)->get();
        foreach ($getorder as $key => $ord) {
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
            $order_status = $ord->order_status;
        }
        $customer = DB::table('tbl_customer')->where('customer_id', $customer_id)->first();
        $shipping = DB::table('tbl_shipping')->where('shipping_id', $shipping_id)->first();
        $order_details_product = DB::table('tbl_order_details')->join('tbl_product', 'tbl_product.product_id', '=', 'tbl_order_details.product_id')->where('order_id', $order_id)->get();
        $output = '';

        $output .= '<style>body{
			font-family: DejaVu Sans;
		}
		.table-styling{
			border: none;
            border-collapse: collapse;
            text-align: left;
            width: 100%;
		}

		.table-styling tbody tr td{
			border:none;
            text-align: left;
		}
        .date{
            float:right;
        }
		</style>
		<h2><center>- Cửa hàng The Shoe Shop - </center></h2>
		<h3><center>Hoá đơn mua hàng</center></h3>
        <label>Mã hoá đơn: ' . $order_id . ' </label>
        <label class="date">' . $ord->order_date . ' </label>
		<p><b>Người đặt hàng</b></p>
	';

        $output .= '

		<label>Tên: ' . $customer->customer_name . '</label>
		<label> | ĐT: ' . $customer->customer_phone . '</label>
		<label> | Email: ' . $customer->customer_email . '</label>
        ';
        $output .= '
        <p><b>Người nhận hàng</b></p>

		<label>Tên: ' . $shipping->shipping_name . '</label>
        <label> | ĐT ' . $shipping->shipping_phone . '</label>
		<label> | Email: ' . $shipping->shipping_email . '</label>
		<p>Địa chỉ: ' . $shipping->shipping_address . '</p>
		<p>Ghi chú: ' . $shipping->shipping_notes . '</p>
        ';
        $output .= '
        <hr>
		<h3>Chi tiết đơn hàng</h3>
		<table class="table-styling">
		<thead>
		<tr>
		<th>Tên sản phẩm</th>

		<th>Số lượng</th>
		<th>Giá sản phẩm</th>
		<th>Thành tiền</th>
		</tr>
		</thead>
		<tbody>';

        $total = 0;

        foreach ($order_details_product as $key => $order_details) {

            $subtotal = $order_details->product_price * $order_details->product_quantity;
            $total += $subtotal;

            $output .= '
			<tr>
			<td>' . $order_details->product_name . '</td>
			<td><center>' . $order_details->product_quantity . '</center></td>
			<td><center>' . number_format($order_details->product_price, 0, ',', '.') . ' VNĐ' . '</center></td>
			<td><center>' . number_format($subtotal, 0, ',', '.') . ' VNĐ' . '</center></td>

			</tr>';
        }

        $output .= '<tr>
		<td colspan="2">
        <br>
		<p>Giá gốc:' . number_format($ord->order_total, 0, ',', '.') . ' VNĐ' . '</p>
           ';
        if ($ord->coupon_total != 0) {
            $output .= '<p>Giảm từ Coupon:' . number_format($ord->order_total - $ord->coupon_total, 0, ',', '.') . ' VNĐ' . '</p>
            <p>Phí ship:' . number_format($ord->order_fee, 0, ',', '.') . ' VNĐ' . '</p>
            <hr>
            <p>Tổng tiền:' . number_format($ord->coupon_total + $ord->order_fee, 0, ',', '.') . ' VNĐ' . '</p>';
        } else {
            $output .= ' <p>Phí ship:' . number_format($ord->order_fee, 0, ',', '.') . ' VNĐ' . '</p>
            <hr>
            <p>Tổng tiền:' . number_format($ord->order_total + $ord->order_fee, 0, ',', '.') . ' VNĐ' . '</p>';
        }
        $output .= '
        </td>
		</tr>
		</tbody>
		</table>
		<table>
		<thead>
		<tr>
		<th width="200px">Người lập phiếu</th>
		<th width="800px">Người nhận</th>
		</tr>
		</thead>
		<tbody>';

        $output .= '
		</tbody>
		</table>
		';
        return $output;
    }
}
