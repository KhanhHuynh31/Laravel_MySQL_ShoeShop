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
    <div class="left-sidebar">
        <h2>Danh mục sản phẩm</h2>
        <div class="panel-group category-products" id="accordian">
            <!--category-productsr-->

            @foreach($category as $key => $cate)
            <div class="panel panel-default">

                @if($cate->category_parent==0)
                <div class="panel-heading">
                    <h4 class="panel-title">

                        <a data-toggle="collapse" data-parent="#accordian" href="#{{$cate->category_id}}">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>

                            <a href="{{URL::to('/category-detail/'.$cate->category_id)}}">{{$cate->category_name}}</a>
                        </a>

                    </h4>
                </div>

                <div id="{{$cate->category_id}}" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            @foreach($category as $key => $cate_sub)
                            @if($cate_sub->category_parent==$cate->category_id)
                            <li><a
                                    href="{{URL::to('/category-detail/'.$cate_sub->category_id)}}">{{$cate_sub->category_name}}</a>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif



            </div>


            @endforeach

        </div>
        <!--/category-products-->

        <div class="brands_products">
            <!--brands_products-->
            <h2>Brands</h2>
            <div class="brands-name">
                <ul class="nav nav-pills nav-stacked">
                    @foreach($brand as $key => $br)
                    <li><a href="{{URL::to('/brand-detail/'.$br->brand_id)}}">{{$br->brand_name}}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!--/brands_products-->
        <div class="brands_products">
            <!--brands_products-->
            <h2>Sản phẩm yêu thích</h2>
            <div class="brands-name ">

                <div id="row_wishlist" class="row">

                </div>

            </div>
        </div>
        <!--/brands_products-->

    </div>
</div>
<div class="features_items">
    <!--features_items-->
    <h2 class="title text-center">Sản phẩm nổi bật</h2>
    @foreach($hot_product as $key => $product)
    <div class="col-sm-4">
        <a id="wishlist_producturl{{$product->product_id}}" href="{{URL::to('/product-detail/'.$product->product_id)}}">
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
        <div class="choose">
            <ul class="nav nav-pills nav-justified">
                <style type="text/css">
                    ul.nav.nav-pills.nav-justified li {
                        text-align: center;
                        font-size: 15px;
                    }

                    .button_wishlist {
                        border: none;
                        background: #ffff;
                        color: #B3AFA8;
                    }

                    ul.nav.nav-pills.nav-justified i {
                        color: #B3AFA8;
                    }

                    .button_wishlist span:hover {
                        color: #FE980F;
                    }

                    .button_wishlist:focus {
                        border: none;
                        outline: none;
                    }
                </style>
                <li>
                    <i class="fa fa-plus-square"></i>
                    <button class="button_wishlist" id="{{$product->product_id}}"
                        onclick="add_wistlist(this.id);"><span>Yêu thích</span></button>
                </li>
            </ul>
        </div>
    </div>
</div>

@endforeach
</div>
<!--features_items-->

<div class="recommended_items">
    <!--recommended_items-->
    <h2 class="title text-center">Sản phẩm mới</h2>
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                @foreach($new_product as $key => $product)
                <div class="col-sm-4">
                    <a href="{{URL::to('/product-detail/'.$product->product_id)}}">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{URL::to('public/uploads/product/'.$product->product_image)}}"
                                        alt="shoe picture" width="300px" height="250px" />
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
    </div>
</div>
<!--/recommended_items-->
@endsection
