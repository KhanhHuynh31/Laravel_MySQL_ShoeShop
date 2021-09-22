@extends('layout')
@section('content')
<div class="shoeAccount container">
    <div class="row">
        <div class="col-xs-12 col-sm-4">
            <div class="left__menu">
                <ul>
                    <li><a class="item__menu" href="">THÔNG TIN TÀI KHOẢN</a></li>
                    <li><a class="item__menu" href="">ĐƠN HÀNG CỦA TÔI</a></li>
                    <li><a class="item__menu" href="">ĐIỂM TÍCH LŨY</a></li>
                    <li><a class="item__menu" href="">ĐỔI MẬT KHẨU</a></li>
                    <li><a class="item__menu" href="">ĐĂNG XUẤT</a></li>
                </ul>
            </div>
        </div>
        <div class="col-xs-12 col-sm-7">
            <div class="right__menu">
                <form action="{{URL::to('/order-place')}}" method="POST">
                    @csrf
                    <input type="text" name="shipping_email" class="form-control form-checkout"
                        value="" placeholder="Email" required="">
                    <input type="text" name="shipping_name" class="form-control form-checkout"
                        value="" placeholder="Họ và tên" required="">
                    <input type="text" name="shipping_phone" class="form-control form-checkout"
                        value="" placeholder="Phone" required="">

                    <div class="form-group city1">
                        <label for="exampleInputPassword1">Chọn thành phố</label>
                        <select name="city" id="city" class="form-control choose city" required="">

                            <option value="">Chọn thành phố</option>


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
                    <input type="text" name="shipping_address" class="form-control form-checkout"
                        value="" placeholder="Số nhà / Tên đường" required="">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
