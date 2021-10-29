@extends('layout')
@section('content')
<div class="col-sm-3">
    @section('attribute')
    @include('pages.include.attribute')
    @endsection
    @yield('attribute')
</div>
<div class="features_items">
    <!--features_items-->
    <h2 class="title text-center">Tìm kiếm</h2>
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
    <div style="clear: both"></div>
    <ul class="pagination pagination-sm m-t-none m-b-none">
        {{$product_details->links("pagination::bootstrap-4")}}
    </ul>
</div>
@endsection
