<!DOCTYPE html>

<head>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
    </script>
    <meta name="csrf-token" content="{{csrf_token()}}">

    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}">
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
    <link rel="stylesheet" href="{{asset('public/backend/css/morris.css')}}" type="text/css" />
    <!-- calendar -->
    <link rel="stylesheet" href="{{asset('public/backend/css/monthly.css')}}">
    <!-- //calendar -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css">
    <!-- //font-awesome icons -->
    {{-- toastr --}}
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
    <script src="{{asset('public/backend/js/raphael-min.js')}}"></script>
    <script src="{{asset('public/backend/js/morris.js')}}"></script>
    <script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

</head>

<body>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="index.html" class="logo">
                    ShoeShop
                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            <!--logo end-->

            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                        <input type="text" class="form-control search" placeholder=" Search">
                    </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="{{asset('public/backend/images/2.png')}}">
                            <span class="username">
                                <?php

                                $name = Auth::user()->admin_name;
                            if($name){
                                echo $name;
                            }
                            ?>

                            </span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            @impersonate
                            <li>
                                <a href="{{URL::to('/impersonate-destroy')}}">Trở về tài khoản gốc</a>
                            </li>
                            @endimpersonate
                            <li><a href="{{URL::to('/logout-auth')}}"><i class="fa fa-key"></i>Đăng xuất</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->

                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li>
                            <a class="active" href="{{URL::to('/dashboard')}}">
                                <i class="fa fa-dashboard"></i>
                                <span>Tổng quan</span>
                            </a>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Đơn hàng</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/manage-order')}}">Quản lý đơn hàng</a></li>


                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Danh mục sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-category-product')}}">Thêm danh mục sản phẩm</a></li>
                                <li><a href="{{URL::to('/all-category-product')}}">Liệt kê danh mục sản phẩm</a></li>

                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Thương hiệu sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-brand-product')}}">Thêm hiệu sản phẩm</a></li>
                                <li><a href="{{URL::to('/all-brand-product')}}">Liệt kê thương hiệu sản phẩm</a></li>

                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-product')}}">Thêm sản phẩm</a></li>
                                <li><a href="{{URL::to('/all-product')}}">Liệt kê sản phẩm</a></li>

                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Mã giảm giá</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/insert-coupon')}}">Thêm mã giảm giá</a></li>
                                <li><a href="{{URL::to('/list-coupon')}}">Liệt kê mã giảm giá</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Vận chuyển</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/delivery')}}">Quản lý vận chuyển</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Bình luận</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/comment')}}">Liệt kê bình luận</a></li>
                            </ul>
                        </li>
                        @hasrole(['admin','author'])
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Tài khoản adnmin</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-users')}}">Thêm tài khoản</a></li>
                                <li><a href="{{URL::to('/users')}}">Liệt kê tài khoản</a></li>

                            </ul>
                        </li>
                        @endhasrole

                    </ul>
                </div>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                @yield('admin_content')
            </section>
        </section>
        <!--main content end-->
    </section>
    <script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script src="{{asset('public/backend/js/scripts.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
    <!-- morris JavaScript -->
    <script src="//cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready( function () {
                $('#myTable').DataTable({
                    searching: true,
                    lengthChange: false,
                    pageLength: 5,
                    info:false,
                    language: {
                        paginate: {
                            previous: '<',
                            next:     '>',
                        },
                    }
                });
            } );
    </script>
    <script type="text/javascript">
        $(document).ready(function(){

            $('#category_order').sortable({
                placeholder: 'ui-state-highlight',
                 update  : function(event, ui)
                  {
                    var page_id_array = new Array();

                    $('#category_order tr').each(function(){
                        page_id_array.push($(this).attr("id"));
                    });

                    $.ajax({
                            url:"{{url('/arrange-category')}}",
                            method:"POST",
                            headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                            data:{page_id_array:page_id_array},
                            success:function(data)
                            {
                                alert(data);
                            }
                    });

                  }
            });


        });
    </script>
    <script type="text/javascript">
        $('.comment_duyet_btn').click(function(){
            var comment_status = $(this).data('comment_status');

            var comment_id = $(this).data('comment_id');
            var comment_product_id = $(this).attr('id');
            if(comment_status==0){
                var alert = 'Thay đổi thành duyệt thành công';
            }else{
                var alert = 'Thay đổi thành không duyệt thành công';
            }
              $.ajax({
                    url:"{{url('/allow-comment')}}",
                    method:"POST",

                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{comment_status:comment_status,comment_id:comment_id,comment_product_id:comment_product_id},
                    success:function(data){
                        location.reload();
                       $('#notify_comment').html('<span class="text text-alert">'+alert+'</span>');

                    }
                });


        });
        $('.btn-reply-comment').click(function(){
            var comment_id = $(this).data('comment_id');

            var comment = $('.reply_comment_'+comment_id).val();

            var comment_product_id = $(this).data('product_id');

              $.ajax({
                    url:"{{url('/reply-comment')}}",
                    method:"POST",

                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{comment:comment,comment_id:comment_id,comment_product_id:comment_product_id},
                    success:function(data){
                        $('.reply_comment_'+comment_id).val('');
                       $('#notify_comment').html('<span class="text text-alert">Trả lời bình luận thành công</span>');

                    }
                });


        });
    </script>
    <script type="text/javascript" src="{{asset('public/backend/js/monthly.js')}}"></script>
    <script type="text/javascript">
        CKEDITOR.replace( 'editor' );
        CKEDITOR.replace( 'editor1' );
        $("form").submit( function(e) {
            var messageLength = CKEDITOR.instances['editor'].getData().replace(/<[^>]*>/gi, '').length;
            if( !messageLength ) {
                alert( 'Chưa nhập mô tả sản phẩm' );
                e.preventDefault();
            }
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){

            fetch_delivery();

            function fetch_delivery(){
                var _token = $('input[name="_token"]').val();
                 $.ajax({
                    url : '{{url('/select-feeship')}}',
                    method: 'POST',
                    data:{_token:_token},
                    success:function(data){
                       $('#load_delivery').html(data);
                    }
                });
            }
            $(document).on('blur','.fee_feeship_edit',function(){

                var feeship_id = $(this).data('feeship_id');
                var fee_value = $(this).text();
                 var _token = $('input[name="_token"]').val();

                $.ajax({
                    url : '{{url('/update-delivery')}}',
                    method: 'POST',
                    data:{feeship_id:feeship_id, fee_value:fee_value, _token:_token},
                    success:function(data){
                       fetch_delivery();
                    }
                });

            });

            $('.add_delivery').click(function(){

               var city = $('.city').val();
               var province = $('.province').val();
               var wards = $('.wards').val();
               var fee_ship = $('.fee_ship').val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url : '{{url('/insert-delivery')}}',
                    method: 'POST',
                    data:{city:city, province:province, _token:_token, wards:wards, fee_ship:fee_ship},
                    success:function(data){
                       fetch_delivery();
                    }
                });


            });
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
                    url : '{{url('/select-delivery')}}',
                    method: 'POST',
                    data:{action:action,ma_id:ma_id,_token:_token},
                    success:function(data){
                       $('#'+result).html(data);
                    }
                });
            });
        })


    </script>
</body>

</html>
