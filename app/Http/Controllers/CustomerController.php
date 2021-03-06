<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\City;
use Toastr;

class CustomerController extends Controller
{
    public function show_account()
    {
        $customer_id = Session::get('customer_id');
        $customer_info = DB::table('tbl_customer')->where('customer_id', $customer_id)->get();
        $city = City::orderby('matp', 'ASC')->get();
        foreach ($customer_info as $key => $info) {
            $customer_city = $info->customer_city;
            $customer_province =  $info->customer_province;
            $customer_wards =  $info->customer_wards;
        }
        $selected_address = DB::table('tbl_tinhthanhpho')->join('tbl_quanhuyen', 'tbl_quanhuyen.matp', '=', 'tbl_tinhthanhpho.matp')->join('tbl_xaphuongthitran', 'tbl_xaphuongthitran.maqh', '=', 'tbl_quanhuyen.maqh')->where('tbl_tinhthanhpho.matp', $customer_city)->where('tbl_quanhuyen.maqh', $customer_province)->where('tbl_xaphuongthitran.xaid', $customer_wards)->get();

        $customer_order = DB::table('tbl_order')->where('customer_id', $customer_id)->get();

        return view('pages.account.show_account')->with('customer_info', $customer_info)->with('customer_order', $customer_order)->with('city', $city)->with('selected_address', $selected_address);
    }

    public function login_customer(Request $request)
    {
        $email = $request->email;
        $password = md5($request->password);
        $result = DB::table('tbl_customer')->where('customer_email', $email)->where('customer_password', $password)->first();
        if ($result) {
            Session::put('customer_id', $result->customer_id);
            Session::put('customer_name', $result->customer_name);
            echo 1;
        } else {
            echo 0;
        }
    }
    public function logout_customer()
    {
        Session::flush();
        return Redirect::to('/home');
    }
    public function add_customer(Request $request)
    {
        $data = array();
        $data['customer_name'] = $request->name;
        $data['customer_phone'] = $request->phone;
        $data['customer_address'] = $request->address;
        $data['customer_email'] = $request->email;
        $data['customer_password'] = md5($request->password);
        $check_email = DB::table('tbl_customer')->where('customer_email', $data['customer_email'])->first();
        if ($check_email) {
            echo 0;
        } else {
            $customer_id = DB::table('tbl_customer')->insertGetId($data);
            Session::put('customer_id', $customer_id);
            Session::put('customer_name', $data['customer_name']);
            echo 1;
        }
    }
    public function change_info(Request $request)
    {
        $customer_id = Session::get('customer_id');
        $selected_data = array();
        $selected_data['customer_address'] = $request->customer_address;
        $selected_data['customer_city'] = $request->city;
        $selected_data['customer_province'] = $request->province;
        $selected_data['customer_wards'] = $request->wards;
        $selected_data['customer_name'] = $request->customer_name;
        $selected_data['customer_phone'] = $request->customer_phone;
        $selected_data['customer_email'] = $request->customer_email;
        Session::put('customer_name', $selected_data['customer_name']);
        DB::table('tbl_customer')->where('customer_id', $customer_id)->update($selected_data);
        Toastr::success('Thay ?????i th??ng tin th??nh c??ng', 'Th??nh c??ng');
        return Redirect::to('/account-info');
    }
    public function change_password(Request $request)
    {
        $customer_id = Session::get('customer_id');
        $selected_data = array();
        $selected_data['customer_current_password'] = md5($request->customer_current_password);
        $selected_data['customer_new_password'] = md5($request->customer_new_password);
        $check_pass = DB::table('tbl_customer')->where('customer_password', $selected_data['customer_current_password'])->first();
        if (!$check_pass && $selected_data['customer_current_password'] != "") {
            echo 0;
        } else {
            DB::table('tbl_customer')->where('customer_id', $customer_id)->update(['customer_password' => $selected_data['customer_new_password']]);
            echo 1;
        }
    }
    public function view_customer_order(Request $request)
    {
        $data = $request->all();
        $orderId = $data['id'];
        $customer_order = array();
        $getorder = DB::table('tbl_order')->where('order_id', $orderId)->get();
        foreach ($getorder as $key => $cus_order) {
            $shipping_id = $cus_order->shipping_id;
            $customer_order['date'] = $cus_order->order_date;
            $customer_order['status'] = $cus_order->order_status;
            $customer_order['ship'] = $cus_order->order_fee;
            $customer_order['coupon'] = $cus_order->coupon_total;
            $customer_order['total'] = $cus_order->order_total;
        }
        $shipping = DB::table('tbl_shipping')->where('shipping_id', $shipping_id)->get();
        foreach ($shipping as $key => $cus_ship) {
            $customer_order['customer_name'] = $cus_ship->shipping_name;
            $customer_order['phone'] = $cus_ship->shipping_phone;
            $customer_order['note'] = $cus_ship->shipping_notes;
            $customer_order['address'] = $cus_ship->shipping_address;
        }
        $getpayment = DB::table('tbl_order')->join('tbl_payment', 'tbl_payment.payment_id', '=', 'tbl_order.payment_id')->where('tbl_order.order_id', $orderId)->get();
        foreach ($getpayment as $key => $pay) {
            $customer_order['payment_method'] = $pay->payment_method;
            if ($customer_order['payment_method'] == 2) {
                $customer_order['payment_method'] = "Ti???n m???t";
            } else {
                $customer_order['payment_method'] = "PayPal";
            }
        }
        $order_details_product = DB::table('tbl_order_details')->join('tbl_product', 'tbl_product.product_id', '=', 'tbl_order_details.product_id')->where('order_id', $orderId)->get();
        $status_text = "";
        $status_line = array("", "", "", "");
        switch ($customer_order['status']) {
            case 1:
                $status_line[0] = "active";
                $status_text = "???? x??c nh???n";
                break;
            case 2:
                $status_line[0] = "active";
                $status_line[1] = "active";
                $status_text = "??ang v???n chuy???n";
                break;
            case 3:
                $status_line[0] = "active";
                $status_line[1] = "active";
                $status_line[2] = "active";
                $status_text = "??ang giao ?????n b???n";
                break;
            case 4:
                $status_line[0] = "active";
                $status_line[1] = "active";
                $status_line[2] = "active";
                $status_line[3] = "active";
                $status_text = "???? giao h??ng";
                break;
            default:
                $status_text = "Ch??? x??c nh???n";
        }
        $output = '';
        $output = '
        <p><b>T??n ng?????i nh???n h??ng: </b><span id="shipping__name">' . $customer_order['customer_name'] . '</span></p>
            <p><b>Ghi ch??: </b><span id="shipping__note">' . $customer_order['note'] . '</span></p>

            <div class="row">
                <div class="col-md-6">
                    <p><b>?????a ch??? nh???n h??ng: </b></p> <span id="shipping__address">' . $customer_order['address'] . '</span>
                </div>
                <div class="col-md-2">
                    <p><b>S??? ??i???n tho???i: </b></p> <span id="shipping__phone">' . $customer_order['phone'] . '</span>
                </div>
                <div class="col-md-2">
                    <p><b>H??nh th???c thanh to??n: </b></p> <span>' . $customer_order['payment_method'] . '</span>
                </div>
                <div class="col-md-2">
                    <p><b>T??nh tr???ng: </b></p> <span id="order__status">' . $status_text . '</span>
                </div>

            </div>
            <div class="track">
                <div class="step ' . $status_line[0] . ' "> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                        class="text">X??c nh???n ????n h??ng</span> </div>
                <div class="step ' . $status_line[1] . '"> <span class="icon"> <i class="fa fa-user"></i> </span> <span
                        class="text">??ang v???n chuy???n</span> </div>
                <div class="step ' . $status_line[2] . '"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span
                        class="text">??ang giao ?????n b???n</span> </div>
                <div class="step ' . $status_line[3] . '"> <span class="icon"> <i class="fa fa-box"></i> </span> <span
                        class="text">???? giao h??ng</span> </div>
            </div>
            <hr>
            <ul class="row">

        ';

        foreach ($order_details_product as $key => $cus_or_deatails) {

            $output .= '
            <li class="col-md-4">
                    <figure class="itemside mb-3">
                                    <div class="aside"><img src="' . url('/public/uploads/product/' . $cus_or_deatails->product_image . '') . '" alt="" class="img-sm border">
                                    </div>
                                    <figcaption class="info align-self-center">
                                        <p class="title"><span id="product__name">' . $cus_or_deatails->product_name . '</span> <br><b>S??? l?????ng: </b><span
                                                id="product__qty">' . $cus_or_deatails->product_quantity . '</span><br><b>Size: </b><span id="product__size">' . $cus_or_deatails->product_size . '</span></p>
                                        <span class="text-muted" id="product__price">' . number_format($cus_or_deatails->product_price, 0, '.', '.') . ' ???' . '</span>
                                    </figcaption>
                        </figure>
            </li>
            ';
        }
        $output .= ' </ul>';
        if ($customer_order['status'] == 4) {
            $output .= '
        <p class="del__order">C???m ??n b???n ???? mua h??ng ??? TheShoeShop</p>
        ';
        } else {
            $output .= '
        <a class="del__order" href="' . url('/account-info') . '">H???y ????n</a>
        ';
        }
        $output .= '
        <div class="customer__order">
            <table style="width:100%">
                <tr>
                    <td><b>T???ng ti???n h??ng: </b></td>
                    <td>' . number_format($customer_order['total'], 0, '.', '.') . ' ???' . '</td>
                </tr>
                <tr>
                    <td><b>Ph?? v???n chuy???n: </b></td>
                    <td><span id="order__ship">' . number_format($customer_order['ship'], 0, '.', '.') . ' ???' . '</span></td>
                </tr>
                <tr>
                    <td><b>Gi???m gi??: </b></td>
                    <td><span id="order__coupon">' . number_format($customer_order['coupon'], 0, '.', '.') . ' ???' . '</span></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <hr>
                    </td>
                </tr>
                <tr>
                    <td><b>T???ng h??a ????n: </b></td>
                    <td><span id="order__total">' . number_format($customer_order['total'] - $customer_order['coupon'] + $customer_order['ship'], 0, '.', '.') . ' ???'  . '</span></td>
                </tr>
            </table>
        </div>

        ';
        echo $output;
    }
}
