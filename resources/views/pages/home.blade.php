@extends('layout')
@section('content')
<section id="slider">
    <!--slider-->
    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
            <li data-target="#slider-carousel" data-slide-to="1"></li>
            <li data-target="#slider-carousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner homeslide">
            <div class="item active">
                <img src="{{asset('public/uploads/slide/slideshoe1.jpg')}}">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Giảm 50% giá sản phẩm của hãng NIKE</h5>
                </div>
            </div>
            <div class="item">
                <img src="{{asset('public/uploads/slide/slideshoe2.jpg')}}">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Giảm 50% giá sản phẩm của hãng NIKE</h5>
                </div>
            </div>
            <div class="item">
                <img src="{{asset('public/uploads/slide/slideshoe3.jpg')}}">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Giảm 50% giá sản phẩm của hãng NIKE</h5>
                </div>
            </div>
        </div>
        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>
    </div>

</section>
<!--/slider-->
<div class="col-sm-3">
    @section('attribute')
    @include('pages.include.attribute')
    @endsection
    @yield('attribute')
</div>
<div class="col-sm-9 padding-right">
    <div class="features_items">
        <!--features_items-->
        <h2 class="title text-center">Sản phẩm nổi bật</h2>
        @foreach($hot_product as $key => $product)
        <div class="col-sm-4">
            <a id="wishlist_producturl{{$product->product_id}}"
                href="{{URL::to('/product-detail/'.$product->product_id)}}">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <input type="hidden" id="wishlist_productname{{$product->product_id}}"
                                value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
                            <input type="hidden" id="wishlist_productprice{{$product->product_id}}"
                                value="{{number_format($product->product_price,0,',','.')}}VNĐ">

                            <img id="wishlist_productimage{{$product->product_id}}"
                                src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="shoe picture"
                                width="300px" height="250px" />
                            <h2>{{number_format($product->product_price).' '.'VNĐ'}}</h2>
                            <p class="tensp">{{$product->product_name}}</p>
                        </div>
                    </div>
            </a>
        </div>
    </div>

    @endforeach
</div>
<!--features_items-->

<div class="recommended_items">
    <!--recommended_items-->
    <h2 class="title text-center">Sản phẩm mới</h2>
    <div class="owl-carousel owl-theme">
        @foreach($new_product as $key => $product)
        <div>
            <a href="{{URL::to('/product-detail/'.$product->product_id)}}">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="shoe picture"
                                width="300px" height="250px" />
                            <h2>{{number_format($product->product_price).' '.'VNĐ'}}</h2>
                            <p class="tensp">{{$product->product_name}}</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</div>
<!--/recommended_items-->
</div>
@endsection
