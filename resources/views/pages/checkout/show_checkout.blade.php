@extends('layout')
@section('content')

<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
                <li class="active">Thanh toán giỏ hàng</li>
            </ol>
        </div>
        <!--/register-req-->

        <div class="shopper-informations">
            <div class="row">

                <div class="col-sm-12 clearfix">
                    <div class="bill-to">
                        <p>Điền thông tin gửi hàng</p>
                        <div class="col-md-6 form-style">
                            <form action="{{URL::to('/save-checkout-customer')}}" method="POST">
                                @csrf
                                <input type="text" name="shipping_email" class="form-control"
                                    value="{{$customer->customer_email }}" placeholder="Email">
                                <input type="text" name="shipping_name" class="form-control"
                                    value="{{$customer->customer_name }}" placeholder="Họ và tên">
                                <input type="text" name="shipping_address" class="form-control"
                                    value="{{$customer->customer_address }}" placeholder="Địa chỉ">
                                <input type="text" name="shipping_phone" class="form-control"
                                    value="{{$customer->customer_phone }}" placeholder="Phone">
                                <textarea name="shipping_notes" class="form-control"
                                    placeholder="Ghi chú đơn hàng của bạn" rows="16"></textarea>

                                @if(Session::get('fee'))
                                <input type="hidden" name="order_fee" class="order_fee" value="{{Session::get('fee')}}">
                                @else
                                <input type="hidden" name="order_fee" class="order_fee" value="10000">
                                @endif

                                @if(Session::get('coupon'))
                                @foreach(Session::get('coupon') as $key => $cou)
                                <input type="hidden" name="order_coupon" class="order_coupon"
                                    value="{{$cou['coupon_code']}}">
                                @endforeach
                                @else
                                <input type="hidden" name="order_coupon" class="order_coupon" value="no">
                                @endif



                                <div class="">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Chọn hình thức thanh toán</label>
                                        <select name="payment_select"
                                            class="form-control input-sm m-bot15 payment_select">
                                            <option value="0">Qua chuyển khoản</option>
                                            <option value="1">Tiền mặt</option>
                                        </select>
                                    </div>
                                </div>
                                <input type="submit" value="Gửi" name="send_order" class="btn btn-primary btn-sm">
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form>
                                @csrf

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn thành phố</label>
                                    <select name="city" id="city" class="form-control input-sm m-bot15 choose city">

                                        <option value="">--Chọn tỉnh thành phố--</option>
                                        @foreach($city as $key => $ci)
                                        <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn quận huyện</label>
                                    <select name="province" id="province"
                                        class="form-control input-sm m-bot15 province choose">
                                        <option value="">--Chọn quận huyện--</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn xã phường</label>
                                    <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                        <option value="">--Chọn xã phường--</option>
                                    </select>
                                </div>


                                <input type="button" value="Tính phí vận chuyển" name="calculate_order"
                                    class="btn btn-primary btn-sm calculate_delivery">


                            </form>
                            @if(Session::get('fee'))
                            <li>
                                <a class="cart_quantity_delete" href="{{url('/del-fee')}}"><i
                                        class="fa fa-times"></i></a>

                                Phí vận chuyển <span>{{number_format(Session::get('fee'),0,',','.')}}đ</span></li>
                            @endif
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</section>
<!--/#cart_items-->

@endsection
