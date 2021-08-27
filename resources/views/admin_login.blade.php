<!DOCTYPE html>

<head>
    <title>Admin ShoeShop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
    </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
    <link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet" />
    <!-- font CSS -->
    <link
        href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css" />
    <link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet">
    <!-- //font-awesome icons -->
    <script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
</head>

<body>
    <div class="log-w3">
        <div class="w3layouts-main">
            <h2>Login</h2>
            <?php
    $mess=Session::get('message');
    if($mess){
        echo '<span class="text-alert">'.$mess.'</span>';
        Session::put('message',null);
    }
    ?>
            <form action="{{URL::to('/admin-dashboard')}}" method="post">
                {{ csrf_field() }}
                <input type="text" class="ggg" name="admin_user" placeholder="User name" required="">
                <input type="password" class="ggg" name="admin_password" placeholder="Password" required="">
                <div class="clearfix"></div>
                <div class="g-recaptcha maxacnhan" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
                @if($errors->has('g-recaptcha-response'))
                <span class="invalid-feedback" style="display:block">
                    <strong>{{$errors->first('g-recaptcha-response')}}</strong>
                </span>
                @endif
                <input type="submit" value="Đăng nhập" name="login">

            </form>
            <a href="{{url('/register-auth')}}">Đăng ký Auth</a> |
            <a href="{{url('/login-auth')}}">Đăng nhập Auth</a>
        </div>
    </div>
    <script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script src="{{asset('public/backend/js/scripts.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</body>

</html>
