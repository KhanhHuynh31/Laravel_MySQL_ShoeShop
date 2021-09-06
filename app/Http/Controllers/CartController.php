<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Cart;
use Carbon\Carbon;

session_start();
class CartController extends Controller
{
    public function save_cart(Request $request)
    {
        $productId = $request->productid_hidden;
        $quantity = $request->qty;
        $product_info = DB::table('tbl_product')->where('product_id', $productId)->first();
        // Cart::destroy();
        $data['id'] = $product_info->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['weight'] = $product_info->product_price;
        $data['options']['image'] = $product_info->product_image;
        Cart::add($data);
        // Cart::destroy();
        return Redirect::to('/show-cart');
    }
    public function check_coupon(Request $request)
    {
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y');
        $data = $request->all();
        $orderTotal = $data['order'];
        $coupon = DB::table('tbl_coupon')->where('coupon_code', $data['coupon'])->where('coupon_status', 1)->where('coupon_end', '>=', $today)->first();
        if ($coupon) {
            $count_coupon = DB::table('tbl_coupon')->count();
            if ($count_coupon > 0) {
                $coupon_session = Session::get('coupon');
                if ($coupon_session == true) {
                    $is_avaiable = 0;
                    if ($is_avaiable == 0) {
                        $cou = array();
                        $cou['coupon_code'] = $coupon->coupon_code;
                        $cou['coupon_condition'] = $coupon->coupon_condition;
                        if ($cou['coupon_condition'] == 1) {
                            $cou['coupon_number'] =  $orderTotal * $coupon->coupon_number / 100;
                        } else {
                            $cou['coupon_number'] = $coupon->coupon_number;
                        }
                        $cou['coupon_with_order'] = $orderTotal - $cou['coupon_number'];
                        Session::put('total_coupon', $cou['coupon_number']);
                        Session::save();
                    }
                } else {
                    $cou = array();
                    $cou['coupon_code'] = $coupon->coupon_code;
                    $cou['coupon_condition'] = $coupon->coupon_condition;
                    if ($cou['coupon_condition'] == 1) {
                        $cou['coupon_number'] =  $orderTotal * $coupon->coupon_number / 100;
                    } else {
                        $cou['coupon_number'] = $coupon->coupon_number;
                    }
                    $cou['coupon_with_order'] = $orderTotal -  $cou['coupon_number'];
                    Session::put('total_coupon', $cou['coupon_number']);
                    Session::save();
                }

                $cou = array();
                $cou['coupon_code'] = $coupon->coupon_code;
                $cou['coupon_condition'] = $coupon->coupon_condition;
                if ($cou['coupon_condition'] == 1) {
                    $cou['coupon_number'] =  $orderTotal * $coupon->coupon_number / 100;
                } else {
                    $cou['coupon_number'] = $coupon->coupon_number;
                }
                if (Session::get('total_shipping') != "") {
                    $cou['coupon_with_order'] = $orderTotal -  $cou['coupon_number'] + Session::get('total_shipping');
                } else {
                    $cou['coupon_with_order'] = $orderTotal -  $cou['coupon_number'];
                }
                Session::put('total_coupon', $cou['coupon_number']);
                Session::save();
                print json_encode($cou);
            }
        } else {
            $cou = array();
            $cou['coupon_status'] = 0;
            if (Session::get('total_shipping') != "") {
                $cou['total_shipping'] = Session::get('total_shipping') + $orderTotal;
            } else {
                $cou['total_shipping'] = $orderTotal;
            }
            Session::put('total_coupon', "");
            Session::save();
            print json_encode($cou);
        }
    }
    public function show_cart()
    {
        return view('pages.cart.show_cart');
    }
    public function delete_to_cart($rowId)
    {
        Cart::update($rowId, 0);
        return Redirect::to('/show-cart');
    }
    public function update_cart_quantity(Request $request)
    {
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;
        Cart::update($rowId, $qty);
        return Redirect::to('/show-cart');
    }
}
