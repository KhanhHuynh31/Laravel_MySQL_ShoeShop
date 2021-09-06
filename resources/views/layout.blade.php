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
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('public/frontend/owlcarousel/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/frontend/owlcarousel/assets/owl.theme.default.min.css')}}">
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
                                <li><a href="#"><i class="fa fa-user"></i> Account</a></li>
                                <li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
                                <li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                                <li><a href="cart.html"><i class="fa fa-shopping-cart"></i> Cart</a></li>
                                <li><a href="login.html"><i class="fa fa-lock"></i> Login</a></li>
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
                                <li><a href="index.html" class="active">Home</a></li>
                                <li><a href="index.html">Products</a></li>
                                <li><a href="contact-us.html">Contact</a></li>
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
                                <li><a href="#">Change Location</a></li>
                                <li><a href="#">FAQ’s</a></li>
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
                                <li><a href="#">Gift Cards</a></li>
                                <li><a href="#">Shoes</a></li>
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
                                <li><a href="#">Billing System</a></li>
                                <li><a href="#">Ticket System</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Company Information</a></li>
                                <li><a href="#">Careers</a></li>
                                <li><a href="#">Store Location</a></li>
                                <li><a href="#">Affillate Program</a></li>
                                <li><a href="#">Copyright</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>About Shopper</h2>
                            <div class="row">
                                <div class="address">
                                    <img src="{{asset('public/frontend/images/home/map.png')}}" alt="" />
                                    <p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--/Footer-->

    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="{{asset('public/frontend/js/sweetalert.js')}}"></script>
    <script src="{{asset('public/frontend/owlcarousel/owl.carousel.min.js')}}"></script>


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
    <script type="text/javascript">
        $(document).ready(function(){
            $(".owl-carousel").owlCarousel();
        });
    </script>
    <script type="text/javascript">
        function view(){


            if(localStorage.getItem('data')!=null){

                var data = JSON.parse(localStorage.getItem('data'));

                data.reverse();

                document.getElementById('row_wishlist').style.overflow = 'scroll';
                document.getElementById('row_wishlist').style.height = '500px';

                for(i=0;i<data.length;i++){

                   var name = data[i].name;
                   var price = data[i].price;
                   var image = data[i].image;
                   var url = data[i].url;

                   $('#row_wishlist').append('<div class="row" style="margin:10px 0"><div class="col-md-4"><img width="100%" src="'+image+'"></div><div class="col-md-8 info_wishlist"><p>'+name+'</p><p style="color:#FE980F">'+price+'</p><a href="'+url+'">Xem chi tiết</a></div><button class="delete_withlist" onclick="del_wistlist('+i+');"><span>Xoá</span></button>');
               }

           }

       }

       view();


      function add_wistlist(clicked_id){

           var id = clicked_id;
           var name = document.getElementById('wishlist_productname'+id).value;
           var price = document.getElementById('wishlist_productprice'+id).value;
           var image = document.getElementById('wishlist_productimage'+id).src;
           var url = document.getElementById('wishlist_producturl'+id).href;

           var newItem = {
               'url':url,
               'id' :id,
               'name': name,
               'price': price,
               'image': image
           }

           if(localStorage.getItem('data')==null){
              localStorage.setItem('data', '[]');
           }

           var old_data = JSON.parse(localStorage.getItem('data'));

           var matches = $.grep(old_data, function(obj){
               return obj.id == id;
           })

           if(matches.length){
               alert('Sản phẩm bạn đã yêu thích,nên không thể thêm');

           }else{

               old_data.push(newItem);
               $('#row_wishlist').append('<div class="row" style="margin:10px 0"><div class="col-md-4"><img width="100%" src="'+newItem.image+'"></div><div class="col-md-8 info_wishlist"><p>'+newItem.name+'</p><p style="color:#FE980F">'+newItem.price+'</p><a href="'+newItem.url+'">Xem chi tiết</a></div><button class="delete_withlist" onclick="del_wistlist();"><span>Xoá</span></button>');


           }

           localStorage.setItem('data', JSON.stringify(old_data));
      }
      function del_wistlist()
      {
          localStorage.clear();
          window.location.reload();
     }


    </script>
    <script type="text/javascript">
        $(document).on('click','.delete_withlist',function(event) {
              event.preventDefault();
              var id = $(this).data('id');
              if (result) {
                for(var i = 0; i < result.length; i++) {
                    if(result[i].id == id) {
                     result.splice(i,i);
                     break;
                 }
             }
             localStorage.setItem('data',JSON.stringify(result));
             swal({
                title: 'Sản phẩm đã được xóa khỏi danh mục yêu thích!!!',
                icon: "success",
                button: "Quay lại",
            }).then(ok=>{
               window.location.reload();
            });

         }
         if(result.length==1){
          for(var i = 0; i < result.length; i++) {
            if(result[i].id == id) {
             result.splice(i,1);
             break;
         }
     }
     localStorage.setItem('data',JSON.stringify(result));
     swal({
                title: 'Sản phẩm đã được xóa khỏi danh mục yêu thích!!!',
                icon: "success",
                button: "Quay lại",
            }).then(ok=>{
               window.location.reload();
            });
 }

});
    </script>

    <script type="text/javascript">
        function remove_background(product_id)
         {
          for(var count = 1; count <= 5; count++)
          {
           $('#'+product_id+'-'+count).css('color', '#ccc');
          }
        }
        //hover chuột đánh giá sao
       $(document).on('mouseenter', '.rating', function(){
          var index = $(this).data("index");
          var product_id = $(this).data('product_id');
        // alert(index);
        // alert(product_id);
          remove_background(product_id);
          for(var count = 1; count<=index; count++)
          {
           $('#'+product_id+'-'+count).css('color', '#ffcc00');
          }
        });
       //nhả chuột ko đánh giá
       $(document).on('mouseleave', '.rating', function(){
          var index = $(this).data("index");
          var product_id = $(this).data('product_id');
          var rating = $(this).data("rating");
          remove_background(product_id);
          //alert(rating);
          for(var count = 1; count<=rating; count++)
          {
           $('#'+product_id+'-'+count).css('color', '#ffcc00');
          }
         });

        //click đánh giá sao
        $(document).on('click', '.rating', function(){
              var index = $(this).data("index");
              var product_id = $(this).data('product_id');
                var _token = $('input[name="_token"]').val();
              $.ajax({
               url:"{{url('insert-rating')}}",
               method:"POST",
               data:{index:index, product_id:product_id,_token:_token},
               success:function(data)
               {
                if(data == 'done')
                {
                 alert("Bạn đã đánh giá "+index +" trên 5");
                }
                else
                {
                 alert("Lỗi đánh giá");
                }
               }
        });

        });
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
        $(document).ready(function(){
            $('.calculate_delivery').click(function(){
                var matp = $('.city').val();
                var maqh = $('.province').val();
                var xaid = $('.wards').val();
                var _token = $('input[name="_token"]').val();
                if(matp == '' && maqh =='' && xaid ==''){
                    alert('Làm ơn chọn để tính phí vận chuyển');
                }else{
                    $.ajax({
                    url : '{{url('/calculate-fee')}}',
                    method: 'POST',
                    data:{matp:matp,maqh:maqh,xaid:xaid,_token:_token},
                    success:function(){
                       location.reload();
                    }
                    });
                }
        });
    });
    </script>



</body>

</html>
