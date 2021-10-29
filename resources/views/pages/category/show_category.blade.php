@extends('layout')
@section('content')
<!--/slider-->
<div class="col-sm-3">
    @section('attribute')
    @include('pages.include.attribute')
    @endsection
    @yield('attribute')
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
    <div style="clear: both"></div>
    <ul class="pagination pagination-sm m-t-none m-b-none">
        {{$category_by_id->links("pagination::bootstrap-4")}}
    </ul>
</div>

@endsection
