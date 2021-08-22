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
                        <div class="form-one">
                            <form action="{{URL::to('/save-checkout-customer')}}" method="POST">
                                {{csrf_field()}}
                                <input type="text" name="shipping_email" value="{{$customer->customer_email }}"
                                    placeholder="Email">
                                <input type="text" name="shipping_name" value="{{$customer->customer_name }}"
                                    placeholder="Họ và tên">
                                <input type="text" name="shipping_address" value="{{$customer->customer_address }}"
                                    placeholder="Địa chỉ">
                                <input type="text" name="shipping_phone" value="{{$customer->customer_phone }}"
                                    placeholder="Phone">
                                <textarea name="shipping_notes" placeholder="Ghi chú đơn hàng của bạn"
                                    rows="16"></textarea>
                                <input type="submit" value="Gửi" name="send_order" class="btn btn-primary btn-sm">
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</section>
<!--/#cart_items-->

@endsection
