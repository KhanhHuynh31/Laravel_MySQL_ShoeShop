<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\Rules\Captcha;
use Validator;
use Auth;

session_start();

class AdminController extends Controller
{
    public function AuthLogin()
    {
        if (Session::get('login_normal')) {

            $admin_id = Session::get('admin_id');
        } else {
            $admin_id = Auth::id();
        }
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function index()
    {
        return view('admin_login');
    }
    public function show_dashboard()
    {
        $this->AuthLogin();
        return view('admin.dashboard');
    }
    public function dashboard(Request $request)
    {
        $request->validate([
            'g-recaptcha-response' => new Captcha(),
        ]);
        $admin_user = $request->admin_user;
        $admin_password =  $request->admin_password;
        $result = DB::table('tbl_admin')->where('admin_user', $admin_user)->where('admin_password', $admin_password)->first();
        if ($result) {
            Session::put('admin_name', $result->admin_name);
            Session::put('admin_id', $result->admin_id);
            return Redirect::to('/dashboard');
        } else {
            Session::put('message', 'Sai tên tài khoản hoặc mật khẩu');
            return Redirect::to('/admin');
        }
    }
    public function logout()
    {
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return Redirect::to('/admin');
    }
}
