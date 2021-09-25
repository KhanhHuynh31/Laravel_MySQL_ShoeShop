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
    public function change_info(Request $request)
    {
        $customer_id = Session::get('customer_id');
        $address_data = array();
        $address_data['city'] = $request->city;
        $address_data['province'] = $request->province;
        $address_data['wards'] = $request->wards;
        $selected_address = DB::table('tbl_tinhthanhpho')->join('tbl_quanhuyen', 'tbl_quanhuyen.matp', '=', 'tbl_tinhthanhpho.matp')->join('tbl_xaphuongthitran', 'tbl_xaphuongthitran.maqh', '=', 'tbl_quanhuyen.maqh')->where('tbl_tinhthanhpho.matp', $address_data['city'])->where('tbl_quanhuyen.maqh', $address_data['province'])->where('tbl_xaphuongthitran.xaid', $address_data['wards'])->select('tbl_tinhthanhpho.name_city', 'tbl_quanhuyen.name_quanhuyen', 'tbl_xaphuongthitran.name_xaphuong')->get();
        foreach ($selected_address as $key => $add) {
            $city = $add->name_city;
            $province =  $add->name_quanhuyen;
            $wards =  $add->name_xaphuong;
        }
        $selceted_address = ", " . $city . ", " . $province . ", " . $wards;
        $selected_data = array();
        $selected_data['customer_address'] = $request->customer_address . $selceted_address;
        $selected_data['customer_name'] = $request->customer_name;
        $selected_data['customer_phone'] = $request->customer_phone;
        $selected_data['customer_email'] = $request->customer_email;
        Session::put('customer_name', $selected_data['customer_name']);
        DB::table('tbl_customer')->where('customer_id', $customer_id)->update($selected_data);
        return Redirect::to('/account-info');
    }
}
