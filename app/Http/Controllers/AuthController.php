<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use DB;
use Auth;
use App\Rules\Captcha;
use Illuminate\Support\Carbon;

class AuthController extends Controller
{

    public function register_auth()
    {
        return view('admin.custom_auth.register');
    }
    public function login_auth()
    {
        return view('admin.custom_auth.login_auth');
    }
    public function logout_auth()
    {
        Auth::logout();
        return redirect('/login-auth')->with('message', 'Đăng xuất authentication thành công');
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'g-recaptcha-response' => new Captcha(),
            'admin_email' => 'required|email|max:255',
            'admin_password' => 'required|max:255'
        ]);

        if (Auth::attempt(['admin_email' => $request->admin_email, 'admin_password' => $request->admin_password])) {
            return redirect('/dashboard');
        } else {
            return redirect('/login-auth')->with('message', 'Lỗi đăng nhập authentication');
        }
    }
    public function show_dashboard()
    {
        $all_customer = DB::table('tbl_customer')->count();
        $all_order = DB::table('tbl_order')->where('order_status',0)->count();
        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $all_order_total =  DB::table('tbl_order')->whereBetween('order_date', [$sub7days, $now])->sum('order_total');
        return view('admin.dashboard')->with('all_customer',$all_customer)->with('all_order',$all_order)->with('all_order_total',$all_order_total);
    }
    public function filter_by_date(Request $request)
    {
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $get = DB::table('tbl_order')->whereBetween('order_date', [$from_date, $to_date])->orderBy('order_date', 'ASC')->get();
        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->order_total,
            );
        }
        echo $data = json_encode($chart_data);
    }
    public function days_order()
    {
        $sub60days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(60)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get = DB::table('tbl_order')->whereBetween('order_date', [$sub60days, $now])->orderBy('order_date', 'ASC')->get();
        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->order_total,

            );
        }
        echo $data = json_encode($chart_data);
    }
    public function dashboard_filter(Request $request)
    {
        $data = $request->all();
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
        $dauthang9 = Carbon::now('Asia/Ho_Chi_Minh')->subMonth(2)->startOfMonth()->toDateString();
        $cuoithang9 = Carbon::now('Asia/Ho_Chi_Minh')->subMonth(2)->endOfMonth()->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        if ($data['dashboard_value'] == '7ngay') {
            $get = DB::table('tbl_order')->whereBetween('order_date', [$sub7days, $now])->orderBy('order_date', 'ASC')->get();
        } elseif ($data['dashboard_value'] == 'thangtruoc') {
            $get = DB::table('tbl_order')->whereBetween('order_date', [$dau_thangtruoc, $cuoi_thangtruoc])->orderBy('order_date', 'ASC')->get();
        } elseif ($data['dashboard_value'] == 'thangnay') {
            $get = DB::table('tbl_order')->whereBetween('order_date', [$dauthangnay, $now])->orderBy('order_date', 'ASC')->get();
        } elseif ($data['dashboard_value'] == 'thang9') {
            $get = DB::table('tbl_order')->whereBetween('order_date', [$dauthang9, $cuoithang9])->orderBy('order_date', 'ASC')->get();
        } else {
            $get = DB::table('tbl_order')->whereBetween('order_date', [$sub365days, $now])->orderBy('order_date', 'ASC')->get();
        }
        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->order_total,
            );
        }
        echo $data = json_encode($chart_data);
    }

}
