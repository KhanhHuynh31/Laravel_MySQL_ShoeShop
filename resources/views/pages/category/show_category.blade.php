@extends('layout')
@section('content')
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
        <!--/shipping-->

    </div>
</div>

<div class="features_items">
    <div class="row">

        <div class="col-md-4">

            <label for="amount">Sắp xếp theo</label>

            <form>
                @csrf
                <select name="sort" id="sort" class="form-control">
                    <option value="{{Request::url()}}?sort_by=none">-Sắp xếp-</option>
                    <option value="{{Request::url()}}?sort_by=tang_dan">Giá tăng dần</option>
                    <option value="{{Request::url()}}?sort_by=giam_dan">Giá giảm dần</option>
                    <option value="{{Request::url()}}?sort_by=kytu_az">Lọc theo tên A đến Z</option>
                    <option value="{{Request::url()}}?sort_by=kytu_za">Lọc theo tên Z đến A</option>
                </select>

            </form>

        </div>

    </div>
    @foreach($category_name as $key => $cate)
    <h2 class="title text-center">{{$cate->category_name}}</h2>
    @endforeach
    @foreach($category_by_id as $key => $product)
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
    <ul class="pagination pagination-sm m-t-none m-b-none">
        {{$category_by_id->links("pagination::bootstrap-4")}}
    </ul>
</div>

@endsection
