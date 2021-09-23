<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\City;
class CustomerController extends Controller
{
    public function show_account()
    {
        $customer_id = Session::get('customer_id');
        $customer_info = DB::table('tbl_customer')->where('customer_id', $customer_id)->get();
        $city = City::orderby('matp', 'ASC')->get();
        $customer_order = DB::table('tbl_order')->where('customer_id', $customer_id)->get();
        return view('pages.account.show_account')->with('customer_info', $customer_info)->with('city', $city)->with('customer_order', $customer_order);
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
}
