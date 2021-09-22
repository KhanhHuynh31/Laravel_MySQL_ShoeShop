<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{
    public function show_account()
    {
        return view('pages.account.show_account');
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
