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
                <?php
                $content = Cart::content();
                ?>
                <div class="col-sm-12 clearfix">
                    <div class="bill-to">
                        <p>Điền thông tin gửi hàng</p>
                        <div class="col-md-7 form-style divCheckout">
                            <form action="{{URL::to('/order-place')}}" method="POST">
                                @csrf
                                <input type="text" name="shipping_email" class="form-control form-checkout"
                                    value="{{$customer->customer_email }}" placeholder="Email" required="">
                                <input type="text" name="shipping_name" class="form-control form-checkout"
                                    value="{{$customer->customer_name }}" placeholder="Họ và tên" required="">
                                <input type="text" name="shipping_phone" class="form-control form-checkout"
                                    value="{{$customer->customer_phone }}" placeholder="Phone" required="">
                                <input type="text" name="shipping_address" class="form-control form-checkout"
                                    value="{{$customer->customer_address }}" placeholder="Địa chỉ" required="">
                                <input type="hidden" id="order_totalFloat1" value="{{Cart::totalFloat()/1.21}}">
                                <div class="form-group city1">
                                    <label for="exampleInputPassword1">Chọn thành phố</label>
                                    <select name="city" id="city" class="form-control choose city" required="">

                                        <option value="">Chọn thành phố</option>
                                        @foreach($city as $key => $ci)
                                        <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group province1">
                                    <label for="exampleInputPassword1">Chọn quận huyện</label>
                                    <select name="province" id="province" class="form-control province choose" required="">
                                        <option value="">Chọn quận huyện</option>

                                    </select>
                                </div>
                                <div class="form-group wards1">
                                    <label for="exampleInputPassword1">Chọn xã phường</label>
                                    <select name="wards" id="wards" class="form-control wards" required="">
                                        <option value="">Chọn xã phường</option>
                                    </select>
                                </div>
                                <textarea name="shipping_notes" class="form-control form-checkout"
                                    placeholder="Ghi chú đơn hàng của bạn" rows="6"></textarea>

                                <h3>Chọn hình thức thanh toán</h3>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_option" value="1"
                                        id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        ATM
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_option" value="2"
                                        id="flexRadioDefault2" checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Trả tiền khi nhận hàng
                                    </label>
                                </div>

                                <input type="submit" value="Hoàn tất đơn hàng" name="send_order"
                                    class="btn btn-primary btn-sm checkoutbutton">
                            </form>
                        </div>

                        <div class="col-md-5">

                            <div class="row mb-5">
                                <h2 class="h3 mb-3 text-black titleCoupon">Mã giảm giá</h2>
                                <div class="p-3 p-lg-5 border">
                                    <div class="input-group divCoupon">
                                        <input type="hidden" id="order_totalFloat" value="{{Cart::totalFloat()/1.21}}">
                                        <input type="text" id="couponCode" class="form-control" name="coupon"
                                            placeholder="Nhập mã giảm giá">
                                        <span class="input-group-btn">
                                            <input type="button" name="check_coupon" value="Áp dụng"
                                                class="applysales btn btn-info">
                                        </span>
                                    </div>
                                    <div id="load-coupon"></div>

                                </div>

                                <div class="col-md-12">
                                    <h2 class="h3 mb-3 text-black">Giỏ hàng của tôi</h2>
                                    <div class="p-3 p-lg-5 border">
                                        <table class="table site-block-order-table mb-5">

                                            <tbody>
                                                @foreach($content as $v_content)

                                                <tr>
                                                    <td>
                                                        <img src="{{URL::to('public/uploads/product/'.$v_content->options->image)}}"
                                                            width="90" alt="" />
                                                    </td>
                                                    <td>{{$v_content->name}}<strong class="mx-2">
                                                            <h5>Số lượng: {{$v_content->qty}}</h5>
                                                    </td>

                                                    <td>{{number_format($v_content->price).' '.'VNĐ'}}</td>
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <td class="text-black font-weight-bold"><strong>Tạm tính</strong>
                                                    </td>
                                                    <td class="text-black">
                                                        {{number_format(Cart::totalFloat()/1.21).' '.'VNĐ'}}</td>
                                                </tr>
                                                <tr id>
                                                    <td class="text-black font-weight-bold"><strong>Coupon giảm:
                                                        </strong></td>
                                                    <td class="text-black" id="coupon-dis">0 VNĐ</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-black font-weight-bold"><strong>Phí vận
                                                            chuyển</strong></td>
                                                    <td class="text-black" id="fee-ship"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-black font-weight-bold"><strong>Tổng hoá
                                                            đơn</strong>
                                                    </td>
                                                    <td class="text-black font-weight-bold" id="totalOrder">
                                                        {{number_format(Cart::totalFloat()/1.21).' '.'VNĐ'}}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!--/#order_items-->
                </div>

            </div>
        </div>

    </div>
    </div>

    </div>
</section>
<!--/#cart_items-->

@endsection
