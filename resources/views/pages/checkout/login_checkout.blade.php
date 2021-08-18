@extends('layout')
@section('content')
<div class="breadcrumbs">
    <ol class="breadcrumb">
        <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
        <li class="active">Thanh toán giỏ hàng</li>
    </ol>
</div>
<div class="container ">
    <div class="row ">
        <div class="col-sm-4 col-sm-offset-1">
            <div class="login-form">
                <!--login form-->
                <h2>Đăng nhập tài khoản</h2>
                <form action="{{URL::to('/login-customer')}}" method="POST">
                    {{csrf_field()}}
                    <input type="text" name="email_account" placeholder="Tài khoản" />
                    <input type="password" name="password_account" placeholder="Password" />
                    <span>
                        <input type="checkbox" class="checkbox">
                        Ghi nhớ đăng nhập
                    </span>
                    <button type="submit" class="btn btn-default">Đăng nhập</button>
                </form>
            </div>
            <!--/login form-->
        </div>

        <div class="col-sm-1">
            <h2 class="or">Hoặc</h2>
        </div>

        <div class="col-sm-4">
            <div class="signup-form">
                <!--sign up form-->
                <h2>Đăng ký</h2>
                <form action="{{URL::to('/add-customer')}}" method="POST">
                    {{ csrf_field() }}
                    <input type="text" name="customer_name" placeholder="Họ và tên" />
                    <input type="email" name="customer_email" placeholder="Địa chỉ email" />
                    <input type="password" name="customer_password" placeholder="Mật khẩu" />
                    <input type="text" name="customer_phone" placeholder="Số điện thoại" />
                    <input type="text" name="customer_address" placeholder="Địa chỉ" />
                    <button type="submit" class="btn btn-default">Đăng ký</button>
                </form>
            </div>
            <!--/sign up form-->
        </div>
    </div>
</div>

@endsection
