<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Admin;
use App\Models\Roles;
use Auth;
use App\Rules\Captcha;

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
        // $data = $request->all();

        if (Auth::attempt(['admin_email' => $request->admin_email, 'admin_password' => $request->admin_password])) {
            return redirect('/dashboard');
        } else {
            return redirect('/login-auth')->with('message', 'Lỗi đăng nhập authentication');
        }
    }
    public function show_dashboard()
    {
        return view('admin.dashboard');
    }
}
