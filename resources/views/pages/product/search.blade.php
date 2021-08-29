@extends('layout')
@section('content')
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
                            {{$cate->category_name}}
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

        <div class="price-range">
            <!--price-range-->

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
    <h2 class="title text-center">Sản phẩm nổi bật</h2>
    @foreach($product_details as $key => $product)
    <div class="col-sm-4">
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
@endsection
