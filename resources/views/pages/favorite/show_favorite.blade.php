@extends('layout')
@section('content')

<section id="cart_items">
    <div class="container">
        <div class="features_items">
            <h2 class="title text-center">Sản phẩm yêu thích</h2>

            @foreach($fav_product as $key => $product)
            <div class="col-sm-4">
                <a href="{{URL::to('/product-detail/'.$product->product_id)}}">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img class="favorite_products" src="{{URL::to('public/uploads/product/'.$product->product_image)}}"
                                    alt="shoe picture" width="400px" height="350px" />
                                    <button type="button" id="delFavorite" value="{{$product->product_id}}">
                                        <i class="fa fa-times"></i>
                                    </button>
                                <h2>{{number_format($product->product_price).' '.'VNĐ'}}</h2>
                                <p class="tensp">{{$product->product_name}}</p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
            <center>
                <ul class="pagination pagination-sm m-t-none m-b-none">
                    {{$fav_product->links("pagination::bootstrap-4")}}
                </ul>
            </center>
        </div>

    </div>
</section>
<!--/#cart_items-->

@endsection
