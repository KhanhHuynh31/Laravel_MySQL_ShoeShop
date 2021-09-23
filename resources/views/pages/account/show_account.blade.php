@extends('layout')
@section('content')
<div class="shoeAccount container">
    <div class="row">
        <div class="col-xs-12 col-sm-4">
            <div class="left__menu">
                <ul>
                    <li><a class="item__menu active" href="#customerInfo" data-toggle="tab">THÔNG TIN TÀI KHOẢN</a></li>
                    <li><a class="item__menu" href="#customerOrder" data-toggle="tab">ĐƠN HÀNG CỦA TÔI</a></li>
                    <li><a class="item__menu" href="">ĐIỂM TÍCH LŨY</a></li>
                    <li><a class="item__menu" href="">ĐỔI MẬT KHẨU</a></li>
                    <li><a class="item__menu" href="">ĐĂNG XUẤT</a></li>
                </ul>
            </div>
        </div>
        <div class="col-xs-12 col-sm-7">
            @foreach($customer_info as $key => $value)
            <div class="right__menu">
                <div class="tab-content">
                    <div id="customerInfo" class="tab-pane fade in active">
                        <form action="">
                            <div class="form-group">
                                <label for="name">Họ tên:</label>
                                <input type="text" class="form-control" id="name" value="{{$value->customer_name}}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" value="{{$value->customer_email}}">
                            </div>
                            <div class="form-group">
                                <label for="phone">Điện thoại:</label>
                                <input type="tel" class="form-control" id="phone" value="{{$value->customer_phone}}">
                            </div>
                            <div class="chose__address">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn thành phố</label>
                                    <select name="city" id="city" class="form-control choose city" required="">
                                        <option value="">Chọn thành phố</option>
                                        @foreach($city as $key => $ci)
                                        <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn quận huyện</label>
                                    <select name="province" id="province" class="form-control province choose"
                                        required="">
                                        <option value="">Chọn quận huyện</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn xã phường</label>
                                    <select name="wards" id="wards" class="form-control wards" required="">
                                        <option value="">Chọn xã phường</option>
                                    </select>
                                </div>
                            </div>
                            <div style="clear: both"></div>
                            <div class="form-group">
                                <label for="address">Số nhà:</label>
                                <input type="text" class="form-control" id="address"
                                    value="{{$value->customer_address}}">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-default">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                    <div id="customerOrder" class="tab-pane fade">
                        <div class="table_box_bootstrap">
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th scope="col">Ngày đặt</th>
                                        <th scope="col">Tổng tiền</th>
                                        <th scope="col">Tình trạng</th>
                                        <th scope="col">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($customer_order as $key => $value)
                                    <tr>
                                        <td>{{$value->order_date}}</td>
                                        <td>{{number_format($value->order_total).' '.'VNĐ'}}</td>
                                        <td>{{$value->order_status}}</td>
                                        <td>
                                            <a href="">Xem chi tiết</a>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
