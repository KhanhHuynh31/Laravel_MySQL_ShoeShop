@extends('layout')
@section('content')
<!--/slider-->
<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Category</h2>
        <div class="panel-group category-products" id="accordian">
            <!--category-productsr-->
            @foreach($category as $key => $cate)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><a
                            href="{{URL::to('/category-detail/'.$cate->category_id)}}">{{$cate->category_name}}</a>
                    </h4>
                </div>
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

        <div class="price-range">
            <!--price-range-->
            <h2>Price Range</h2>
            <div class="well text-center">
                <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5"
                    data-slider-value="[250,450]" id="sl2"><br />
                <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
            </div>
        </div>
        <!--/price-range-->

        <div class="shipping text-center">
            <!--shipping-->
            <img src="{{('public/frontend/images/home/shipping.jpg')}}" alt="" />
        </div>
        <!--/shipping-->

    </div>
</div>
<div class="features_items">
    <!--features_items-->
    @foreach($brand_name as $key => $br)
    <h2 class="title text-center">{{$br->brand_name}}</h2>
    @endforeach
    @foreach($brand_by_id as $key => $product)
    <a href="{{URL::to('/product-detail/'.$product->product_id)}}">
        <div class="col-sm-4">
            <div class="product-image-wrapper">

                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{URL::to('public/uploads/product/'.$product->product_image)}}" alt="" />
                        <h2>{{number_format($product->product_price).' '.'VNĐ'}}</h2>
                        <p>{{$product->product_name}}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ
                            hàng</a>
                    </div>

                </div>
            </div>
        </div>
    </a>
    @endforeach
</div>
<!--features_items-->
<!--/recommended_items-->
@endsection
