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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

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
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="fa fa-user"></i>
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
                                <a href="{{URL::to('/impersonate-destroy')}}">Tr??? v??? t??i kho???n g???c</a>
                            </li>
                            @endimpersonate
                            <li><a href="{{URL::to('/logout-auth')}}"><i class="fa fa-key"></i>????ng xu???t</a></li>
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
                                <span>T???ng quan</span>
                            </a>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>????n h??ng</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/manage-order')}}">Qu???n l?? ????n h??ng</a></li>


                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Danh m???c s???n ph???m</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-category-product')}}">Th??m danh m???c s???n ph???m</a></li>
                                <li><a href="{{URL::to('/all-category-product')}}">Li???t k?? danh m???c s???n ph???m</a></li>

                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Th????ng hi???u s???n ph???m</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-brand-product')}}">Th??m hi???u s???n ph???m</a></li>
                                <li><a href="{{URL::to('/all-brand-product')}}">Li???t k?? th????ng hi???u s???n ph???m</a></li>

                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>S???n ph???m</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-product')}}">Th??m s???n ph???m</a></li>
                                <li><a href="{{URL::to('/all-product')}}">Li???t k?? s???n ph???m</a></li>

                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>M?? gi???m gi??</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/insert-coupon')}}">Th??m m?? gi???m gi??</a></li>
                                <li><a href="{{URL::to('/list-coupon')}}">Li???t k?? m?? gi???m gi??</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>V???n chuy???n</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/delivery')}}">Qu???n l?? v???n chuy???n</a></li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>B??nh lu???n</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/comment')}}">Li???t k?? b??nh lu???n</a></li>
                            </ul>
                        </li>
                        @hasrole(['admin','author'])
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>T??i kho???n adnmin</span>
                            </a>
                            <ul class="sub">
                                <li><a href="{{URL::to('/add-users')}}">Th??m t??i kho???n</a></li>
                                <li><a href="{{URL::to('/users')}}">Li???t k?? t??i kho???n</a></li>

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
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

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
        $( function() {
          $( "#datepicker" ).datepicker({
              prevText:"Th??ng tr?????c",
              nextText:"Th??ng sau",
              dateFormat:"yy-mm-dd",
              dayNamesMin: [ "Th??? 2", "Th??? 3", "Th??? 4", "Th??? 5", "Th??? 6", "Th??? 7", "Ch??? nh???t" ],
              duration: "slow"
          });
          $( "#datepicker2" ).datepicker({
              prevText:"Th??ng tr?????c",
              nextText:"Th??ng sau",
              dateFormat:"yy-mm-dd",
              dayNamesMin: [ "Th??? 2", "Th??? 3", "Th??? 4", "Th??? 5", "Th??? 6", "Th??? 7", "Ch??? nh???t" ],
              duration: "slow"
          });
        } );

    </script>
    <script type="text/javascript">
        $( function() {
          $( "#start_coupon" ).datepicker({
              prevText:"Th??ng tr?????c",
              nextText:"Th??ng sau",
              dateFormat:"dd/mm/yy",
              dayNamesMin: [ "Th??? 2", "Th??? 3", "Th??? 4", "Th??? 5", "Th??? 6", "Th??? 7", "Ch??? nh???t" ],
              duration: "slow"
          });
          $( "#end_coupon" ).datepicker({
              prevText:"Th??ng tr?????c",
              nextText:"Th??ng sau",
              dateFormat:"dd/mm/yy",
              dayNamesMin: [ "Th??? 2", "Th??? 3", "Th??? 4", "Th??? 5", "Th??? 6", "Th??? 7", "Ch??? nh???t" ],
              duration: "slow"
          });
        } );

    </script>
    <script type="text/javascript">
        $(document).ready(function(){
                chart60daysorder(); //g???i h??m load 60 ng??y khi v???a m??? trang
                //C???u h??nh m??u s???c, text, chi???u cao tr???c x theo ng??y th??ng, chi???u cao tr???c y theo gi?? ti???n
                var chart = new Morris.Bar({
                      element: 'chart',
                      //option chart
                      lineColors: ['#819C79', '#fc8710','#FF6541', '#A4ADD3', '#766B56'],
                        parseTime: false,
                        hideHover: 'auto',
                        xkey: 'period',
                        ykeys: ['order'],
                        labels: ['doanh s???']

                    });
                    //h??m load 60 ng??y
                function chart60daysorder(){
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{url('/days-order')}}",
                        method:"POST",
                        dataType:"JSON",
                        data:{_token:_token},

                        success:function(data)
                            {
                                chart.setData(data);
                            }
                    });
                }
               //n??t l???c ch???n s???n nh?? demo, k l??m c??ng ???????c, c??? ????? ????y kh??ng ???nh h?????ng j
            $('.dashboard-filter').change(function(){
                var dashboard_value = $(this).val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{url('/dashboard-filter')}}",
                    method:"POST",
                    dataType:"JSON",
                    data:{dashboard_value:dashboard_value,_token:_token},

                    success:function(data)
                        {
                            chart.setData(data);
                        }
                    });

            });
            //Khi nh???n v??o n??t l???c sau khi ch???n kho???ng ng??y, s??? th???c hi???n load
            $('#btn-dashboard-filter').click(function(){
                var _token = $('input[name="_token"]').val();
                var from_date = $('#datepicker').val();
                var to_date = $('#datepicker2').val();

                 $.ajax({
                    url:"{{url('/filter-by-date')}}",   //url g???i t???i file web.php
                    method:"POST",
                    dataType:"JSON",
                    data:{from_date:from_date,to_date:to_date,_token:_token},   //d??? li???u truy???n theo

                    success:function(data)
                        {
                            chart.setData(data);    //th???c hi???n load tr??n bi???u ?????
                        }
                });

            });

        });
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
                var alert = 'Thay ?????i th??nh duy???t th??nh c??ng';
            }else{
                var alert = 'Thay ?????i th??nh kh??ng duy???t th??nh c??ng';
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
                       $('#notify_comment').html('<span class="text text-alert">Tr??? l???i b??nh lu???n th??nh c??ng</span>');

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
                alert( 'Ch??a nh???p m?? t??? s???n ph???m' );
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
