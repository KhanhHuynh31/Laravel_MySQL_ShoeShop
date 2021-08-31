@extends('layout')
@section('content')

@foreach($product_details as $key => $value)
<div class="product-details">
    <!--product-details-->
    <div class="breadcrumbs">
        <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
            <li class="active">Sản phẩm</li>
        </ol>
    </div>
    <div class="col-sm-5">
        <div class="view-product">
            <img src="{{URL::to('/public/uploads/product/'.$value->product_image)}}" alt="" />
            <h3>ZOOM</h3>
        </div>
    </div>
    <div class="col-sm-7">
        <div class="product-information">
            <!--/product-information-->
            <img src="images/product-details/new.jpg" class="newarrival" alt="" />
            <h2>{{$value->product_name}}</h2>
            <p>Mã ID: {{$value->product_id}}</p>
            <img src="images/product-details/rating.png" alt="" />
            @if($value->product_count!=0)
            <form action="{{URL::to('/save-cart')}}" method="POST">
                {{ csrf_field() }}
                <span>
                    <span>{{number_format($value->product_price).' VNĐ'}}</span>

                    <label>Số lượng:</label>
                    <input name="qty" type="number" min="1" value="1" />
                    <input name="productid_hidden" type="hidden" value="{{$value->product_id}}" />
                    <button type="submit" class="btn btn-fefault cart">
                        <i class="fa fa-shopping-cart"></i>
                        Thêm giỏ hàng
                    </button>
                </span>
            </form>
            <p><b>Tình trạng:</b> Còn hàng</p>
            @else
            <h3>Giá: {{number_format($value->product_price).' VNĐ'}}</h3>
            <p><b>Tình trạng:</b> Hết hàng</p>
            @endif
            <p><b>Thương hiệu:</b> {{$value->brand_name}}</p>
            <p><b>Size:</b> {{$value->category_name}}</p>
            <p><b>Màu:</b> {{$value->category_name}}</p>
            <a href=""><img src="images/product-details/share.png" class="share img-responsive" alt="" /></a>
        </div>
        <!--/product-information-->
    </div>
</div>
<!--/product-details-->

<div class="category-tab shop-details-tab">
    <!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#details" data-toggle="tab">Mô tả</a></li>
            <li><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="details">
            <p>{!! $value->product_desc !!}</p>

        </div>
        <div class="tab-pane fade active in" id="reviews" >
            <div class="col-sm-12">
                <ul>
                    <li><a href=""><i class="fa fa-user"></i>Admin</a></li>
                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                    <li><a href=""><i class="fa fa-calendar-o"></i>16.09.2020</a></li>
                </ul>
                <style type="text/css">
                    .style_comment {
                        border: 1px solid #ddd;
                        border-radius: 10px;
                        background: #F0F0E9;
                    }
                </style>
                <form>
                     @csrf
                    <input type="hidden" name="comment_product_id" class="comment_product_id" value="{{$value->product_id}}">
                     <div id="comment_show"></div>

                </form>

                <p><b>Viết đánh giá của bạn</b></p>

                 <!------Rating here---------->
                            <ul class="list-inline rating"  title="Average Rating">
                                @for($count=1; $count<=5; $count++)
                                    @php
                                        if($count<=$rating){
                                            $color = 'color:#ffcc00;';
                                        }
                                        else {
                                            $color = 'color:#ccc;';
                                        }

                                    @endphp

                                <li title="star_rating" id="{{$value->product_id}}-{{$count}}" data-index="{{$count}}"  data-product_id="{{$value->product_id}}" data-rating="{{$rating}}" class="rating" style="cursor:pointer; {{$color}} font-size:30px;">&#9733;</li>
                                @endfor

                            </ul>
                <form action="#">
                    <span>
                        <input style="width:100%;margin-left: 0" type="text" class="comment_name" placeholder="Tên bình luận"/>

                    </span>
                    <textarea name="comment" class="comment_content" placeholder="Nội dung bình luận"></textarea>
                    <div id="notify_comment"></div>

                    <button type="button" class="btn btn-default pull-right send-comment">
                        Gửi bình luận
                    </button>

                </form>
            </div>
        </div>

    </div>
</div>
<!--/category-tab-->
@endforeach
<div class="recommended_items">
    <!--recommended_items-->
    <h2 class="title text-center">Sản phẩm liên quan</h2>

    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">
                @foreach($related as $key => $rel)
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <a href="{{URL::to('/product-detail/'.$rel->product_id)}}">
                                    <img src="{{URL::to('public/uploads/product/'.$rel->product_image)}}" alt="" />
                                    <h2>{{number_format($rel->product_price).' '.'VNĐ'}}</h2>
                                    <p>{{$rel->product_name}}</p>
                                </a>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm
                                    vào giỏ hàng</a>
                            </div>

                        </div>
                    </div>
                </div>
                @endforeach


            </div>

        </div>
        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>
    </div>
</div>
<!--/recommended_items-->
@endsection
