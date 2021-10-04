<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Shoe for everyone">
    <meta name="keywords" content="shoe" />
    <meta name="robots" content="INDEX,FOLLOW" />
    <link rel="canonical" href="http://localhost/shoeshop" />
    <meta name="author" content="">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <link rel="icon" type="image/x-icon" href="public/frontend/images/home/homelogo.jpg" />

    <meta property="og:image" content="public/frontend/images/home/homelogo.jpg" />
    <meta property="og:site_name" content="shoeshop.com" />
    <meta property="og:description" content="Shoe for everyone" />
    <meta property="og:title" content="The Shoe Shop" />
    <meta property="og:url" content="http://localhost/shoeshop" />
    <meta property="og:type" content="website" />


    <title>The Shoe Shop</title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/fontawesome/css/all.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    <link rel="stylesheet" href="{{asset('public/frontend/owlcarousel/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/owlcarousel/assets/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css">

    <!--[if lt IE 9]>
    <script src="{{asset('public/frontend/js/html5shiv.js')}}"></script>
    <script src="{{asset('public/frontend/js/respond.min.js')}}"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
        href="{{asset('public/frontend/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114"
        href="{{asset('public/frontend/images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72"
        href="{{asset('public/frontend/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed"
        href="{{asset('public/frontend/images/ico/apple-touch-icon-57-precomposed.png')}}">
</head>
<!--/head-->

<body>
    <header id="header">
        <!--header-->
        <div class="header-middle">
            <!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="{{URL::to('home')}}">
                                <img src="{{asset('public/frontend/images/home/homelogo.jpg')}}" width="100px"
                                    height="50px" alt="" />
                                <label>
                                    <h3 class="title-home">&nbsp;The Shoe Shop</h3>
                                </label>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="cart.html"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>

                                <?php
                                $customer_id = Session::get('customer_id');
                                if($customer_id!=NULL){
                                    $customer_name= Session::get('customer_name');

                              ?>
                                <li class="dropdown">
                                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                        <i class="fa fa-user"></i>
                                        <span class="username">
                                            <?php
                                             echo $customer_name;
                                             ?>
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu extended logout">
                                        <li><a href="{{URL::to('/account-info')}}"><i class="fa fa-key"></i> Thông tin
                                                tài
                                                khoản</a></li>
                                        <li><a href="{{URL::to('/show-favorite-product')}}"><i class="fa fa-star"></i>
                                                Yêu thích</a></li>
                                        <li><a href="{{URL::to('/logout-customer')}}"><i class="fa fa-sign-out-alt"></i>
                                                Đăng xuất</a>
                                        </li>
                                    </ul>
                                </li>
                                <?php
                                     }else{
                                         ?>
                                <li><a href="#" data-toggle="modal" data-target=".login-register-form"><i
                                            class="fa fa-lock"></i> Đăng nhập</a></li>

                                <?php
                                     }
                                         ?>



                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-middle-->

        <div class="header-bottom">
            <!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{URL::to('home')}}" class="active">TRANG CHỦ</a></li>
                                <li><a href="{{URL::to('home')}}">SẢN PHẨM</a></li>
                                <li><a href="{{URL::to('home')}}">TIN TỨC</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <form action="{{URL::to('/search')}}" method="POST">
                            {{csrf_field()}}
                            <div class="search_box pull-right">
                                <input type="text" name="searchbox" id="keywords" placeholder="Tìm kiếm"
                                    autocomplete="off" />
                                <div id="search_ajax"></div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-bottom-->
    </header>
    <!--/header-->
    <section>
        <div class="container">
            <div class="row">
                @yield('content')

            </div>

        </div>
    </section>

    <footer id="footer">
        <!--Footer-->
        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Service</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Online Help</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Order Status</a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Quock Shop</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">T-Shirt</a></li>
                                <li><a href="#">Mens</a></li>
                                <li><a href="#">Womens</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Policies</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Terms of Use</a></li>
                                <li><a href="#">Privecy Policy</a></li>
                                <li><a href="#">Refund Policy</a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-5 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Địa chỉ: Số 06 Trần Văn Ơn, Phú Hoà, Thủ Dầu Một, Bình Dương, Việt
                                        Nam</a></li>
                                <li><a href="#">SĐT: 035324110</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--/Footer-->
    {{-- Order Modal --}}
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" style="width:90%; margin: 20px auto" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="exampleModalLabel">HÓA ĐƠN MUA HÀNG - THE SHOE SHOP</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div id="customer_order_show">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Login / Register Modal-->
    <div class="modal fade login-register-form" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span class="glyphicon glyphicon-remove"></span>
                    </button>
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#login-form"> Đăng nhập</a></li>
                        <li><a data-toggle="tab" href="#registration-form"> Đăng ký</a></li>
                    </ul>
                </div>
                <div class="modal-body">
                    <div class="tab-content">
                        <div id="login-form" class="tab-pane fade in active">
                            <div class="form-group">
                                <label for="email_account">Email:</label>
                                <input type="email" class="form-control" id="email_account" placeholder="Nhập Email"
                                    name="email_account">
                            </div>
                            <div class="form-group">
                                <label for="password_account">Password:</label>
                                <input type="password" class="form-control" id="password_account"
                                    placeholder="Nhập password" name="password_account">
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" name="remember"> Lưu đăng nhập
                                </label>
                            </div>
                            <div id="alert-login"></div>
                            <button id="submit-login" class="btn btn-default">Đăng nhập</button>
                        </div>
                        <div id="registration-form" class="tab-pane fade">
                            <div class="form-group">
                                <label for="customer_name">Họ tên <span style="color: red">*</span></label>
                                <input type="text" class="form-control" id="customer_name" placeholder="Nhập họ tên"
                                    name="customer_name">
                            </div>
                            <div class="form-group">
                                <label for="customer_email">Email <span style="color: red">*</span></label>
                                <input type="email" class="form-control" id="customer_email" placeholder="Nhập email"
                                    name="customer_email">
                            </div>
                            <div class="form-group">
                                <label for="customer_password">Password <span style="color: red">*</span></label>
                                <input type="password" class="form-control" id="customer_password"
                                    placeholder="Nhập mật khẩu" name="customer_password">
                            </div>
                            <div class="form-group">
                                <label for="customer_phone">Số điện thoại:</label>
                                <input type="tel" class="form-control" id="customer_phone"
                                    placeholder="Nhập số điện thoại" name="customer_phone">
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-4 form-group city1">
                                        <label for="exampleInputPassword1">Chọn thành phố</label>
                                        <select name="city" id="city" class="form-control choose city" required="">
                                            @foreach($city as $key => $ci)
                                            <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-4 form-group province1">
                                        <label for="exampleInputPassword1">Chọn quận huyện</label>
                                        <select name="province" id="province" class="form-control province choose"
                                            required="">
                                        </select>
                                    </div>
                                    <div class="col-4 form-group wards1">
                                        <label for="exampleInputPassword1">Chọn xã phường</label>
                                        <select name="wards" id="wards" class="form-control wards" required="">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="customer_address">Địa chỉ:</label>
                                <input type="text" class="form-control" id="customer_address" placeholder="Nhập địa chỉ"
                                    name="customer_address">
                            </div>

                            <div id="alert-register"></div>
                            <button type="submit" id="submit-register" class="btn btn-default">Đăng ký</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="{{asset('public/frontend/js/sweetalert.js')}}"></script>
    <script src="{{asset('public/frontend/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('public/frontend/fontawesome/js/all.js')}}"></script>
    <script src="//cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready( function () {
                $('#myTable').DataTable({
                    searching: false,
                    lengthChange: false,
                    pageLength: 5,
                    info:false,
                    language: {
                        paginate: {
                            previous: '<',
                            next:     '>'
                        },
                    }
                });
            } );
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#sort').on('change',function(){
                var url = $(this).val();
                  if (url) {
                      window.location = url;
                  }
                return false;
            });

        });
    </script>
    <script>
        $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
        },
        600:{
            items:2,
        },
        1000:{
            items:3,
        }
    }
})
    </script>

    <script type="text/javascript">
        $(document).ready(function(){

            load_comment();

            function load_comment(){
                var product_id = $('.comment_product_id').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                  url:"{{url('/load-comment')}}",
                  method:"POST",
                  data:{product_id:product_id, _token:_token},
                  success:function(data){

                    $('#comment_show').html(data);
                  }
                });
            }
            $('.send-comment').click(function(){
                var product_id = $('.comment_product_id').val();
                var comment_name = $('.comment_name').val();
                var comment_content = $('.comment_content').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                  url:"{{url('/send-comment')}}",
                  method:"POST",
                  data:{product_id:product_id,comment_name:comment_name,comment_content:comment_content, _token:_token},
                  success:function(data){

                    $('#notify_comment').html('<span class="text text-success">Thêm bình luận thành công, bình luận đang chờ duyệt</span>');
                    load_comment();
                    $('#notify_comment').fadeOut(9000);
                    $('.comment_name').val('');
                    $('.comment_content').val('');
                  }
                });
            });
        });
    </script>
    <script type="text/javascript">
        $('#keywords').keyup(function(){
            var query = $(this).val();

              if(query != '')
                {
                 var _token = $('input[name="_token"]').val();

                 $.ajax({
                  url:"{{url('/autocomplete-ajax')}}",
                  method:"POST",
                  data:{query:query, _token:_token},
                  success:function(data){
                   $('#search_ajax').fadeIn();
                    $('#search_ajax').html(data);
                  }
                 });

                }else{

                    $('#search_ajax').fadeOut();
                }
        });

        $(document).on('click', '.li_search_ajax', function(){
            $('#keywords').val($(this).text());
            $('#search_ajax').fadeOut();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.choose').on('change',function(){
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';

            if(action=='city'){
                result = 'province';
            }else{
                result = 'wards';
            }
            $.ajax({
                url : '{{url('/select-delivery-home')}}',
                method: 'POST',
                data:{action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                   $('#'+result).html(data);
                }
            });
        });
        });

    </script>

    <script type="text/javascript">
        $('.applysales').click(function(){
            var coupon = $('#couponCode').val();
            var order = $('#order_totalFloat').val();

                $.ajax({
                    url:"{{url('/check-coupon')}}",
                    method: "POST",
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{coupon:coupon, order:order},
                    dataType:'json',
                    success:function(data){
                        if(data.coupon_status == 0){
                            $('#load-coupon').html('<span class="text text-alert">Mã giảm giá không hợp lệ</span>');
                            $('#coupon-dis').html('<span class="text text-alert">'+ new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(0)+'</span>');
                            $('#totalOrder').html('<span class="text text-alert">'+ new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(data.total_shipping)+'</span>');
                        }
                        else{
                        $('#load-coupon').html('<span class="text text-alert">Áp dụng mã giảm giá '+data.coupon_code+' thành công</span>');
                        $('#coupon-dis').html('<span class="text text-alert">'+ new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(data.coupon_number)+'</span>');
                        $('#totalOrder').html('<span class="text text-alert">'+ new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(data.coupon_with_order)+'</span>');
                        }
                    }
                });

        });

    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.wards').on('change',function(){
                    var order =$('#order_totalFloat1').val();
                    var matp = $('.city').val();
                    var maqh = $('.province').val();
                    var xaid = $('.wards').val();
                    var _token = $('input[name="_token"]').val();

                    $.ajax({
                    url : '{{url('/calculate-fee')}}',
                    method: 'POST',
                    data:{matp:matp,maqh:maqh,xaid:xaid,order:order,_token:_token},
                    dataType:'json',
                    success:function(data){
                        $('#fee-ship').html('<span class="text text-alert">'+ new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(data.fee_price)+'</span>');
                        $('#totalOrder').html('<span class="text text-alert">'+ new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(data.fee_total)+'</span>');
                    }
                    });



            });
        });
    </script>
    <script type="text/javascript">
        $('#favorite').click(function(){
                var id = $('#favorite').val();
                    $.ajax({
                        url:"{{url('/favorite-product')}}",
                        method: "POST",
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data:{id:id},
                        success:function(data){
                                $('#load-favorite').html('<span class="text text-alert">'+data+'</span>');

                        }
                    });

            });

    </script>
    {{-- Login --}}
    <script type="text/javascript">
        $('#submit-login').click(function(){
                var email = $('#email_account').val();
                var password = $('#password_account').val();
                    $.ajax({
                        url:"{{url('/login-customer')}}",
                        method: "POST",
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data:{email:email, password:password},
                        success:function(data){
                            if(data == 1)
                            {
                                location.reload();
                            }
                            else{
                                $('#alert-login').html('<span class="text text-alert">Sai tài khoản hoặc mật khẩu</span>');
                            }
                        }
                    });
            });
    </script>
    {{-- Register --}}
    <script type="text/javascript">
        $('#submit-register').click(function(){
                var name = $('#customer_name').val();
                var email = $('#customer_email').val();
                var password = $('#customer_password').val();
                var phone = $('#customer_phone').val();
                var address = $('#customer_address').val();
                    $.ajax({
                        url:"{{url('/add-customer')}}",
                        method: "POST",
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data:{name:name, email:email, password:password, phone:phone, address:address},
                        success:function(data){
                            if(data == 1)
                            {
                                location.reload();
                            }
                            else{
                                $('#alert-register').html('<span class="text text-alert">Email đã được sử dụng</span>');
                            }
                        }
                    });
            });
    </script>
    {{-- View Order --}}
    <script type="text/javascript">
        $('.view-order').click(function(){
                var id = $(this).attr('class').split(' ')[1];
                $.ajax({
                        url:"{{url('/view-customer-order')}}",
                        method: "POST",
                        headers:{
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data:{id:id},
                        success:function(data){
                            $('#customer_order_show').html(data);

                        }
                    });

            });
    </script>
</body>

</html>
