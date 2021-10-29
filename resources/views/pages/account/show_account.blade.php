@extends('layout')
@section('content')
<div class="shoeAccount container">
    <div class="row">
        <div class="col-xs-12 col-sm-4">
            <div class="left__menu">
                <ul>
                    <li><a class="item__menu active" href="#customerInfo" data-toggle="tab">THÔNG TIN TÀI KHOẢN</a></li>
                    <li><a class="item__menu" href="#customerPassword" data-toggle="tab">ĐỔI MẬT KHẨU</a></li>
                    <li><a class="item__menu" href="#customerOrder" data-toggle="tab">ĐƠN HÀNG CỦA TÔI</a></li>
                    <li><a class="item__menu" href="{{URL::to('/logout-customer')}}">ĐĂNG XUẤT</a></li>
                </ul>
            </div>
        </div>
        <div class="col-xs-12 col-sm-7">
            @foreach($customer_info as $key => $value)
            <div class="right__menu">
                <div class="tab-content">
                    <div id="customerInfo" class="tab-pane fade in active">
                        <form action="{{URL::to('/change-info')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Họ tên:</label>
                                <input type="text" class="form-control" name="customer_name" id="name"
                                    value="{{$value->customer_name}}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" name="customer_email" id="email"
                                    value="{{$value->customer_email}}" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Điện thoại:</label>
                                <input type="tel" class="form-control" name="customer_phone" id="phone"
                                    value="{{$value->customer_phone}}" required>
                            </div>
                            <div class="chose__address">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn thành phố</label>
                                    <select name="city" id="city" class="form-control choose city" required="">
                                        @foreach($selected_address as $key => $cus_add)
                                        <option selected value="{{$cus_add->matp}}">{{$cus_add->name_city}}</option>
                                        @endforeach
                                        @foreach($city as $key => $ci)
                                        <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn quận huyện</label>
                                    <select name="province" id="province" class="form-control province choose"
                                        required="">
                                        @foreach($selected_address as $key => $cus_add)
                                        <option selected value="{{$cus_add->maqh}}">{{$cus_add->name_quanhuyen}}
                                        </option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Chọn xã phường</label>
                                    <select name="wards" id="wards" class="form-control wards" required="">
                                        @foreach($selected_address as $key => $cus_add)
                                        <option selected value="{{$cus_add->xaid}}">{{$cus_add->name_xaphuong}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div style="clear: both"></div>
                            <div class="form-group">
                                <label for="address">Số nhà:</label>
                                <input type="text" class="form-control" name="customer_address" id="address"
                                    value="{{$value->customer_address}} " required>
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
                                        <?php
                                        switch ($value->order_status) {
                                            case 1:
                                                $status_text="Đã xác nhận";
                                                break;
                                            case 2:
                                                $status_text="Đang vận chuyển";
                                                break;
                                            case 3:
                                                $status_text="Đang giao đến bạn";
                                                break;
                                            case 4:
                                                $status_text="Đã giao hàng";
                                                break;
                                            default:
                                                $status_text="Chờ xác nhận";
                                        }
                                        ?>
                                        <td>{{$status_text}}</td>
                                        <td>
                                            <a class="view-order {{$value->order_id}}" data-toggle="modal"
                                                data-target="#exampleModal" href="">Xem chi
                                                tiết</a>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>

                    </div>
                    <div id="customerPassword" class="tab-pane fade">
                        <div id="alert-password"></div>
                            <div class="form-group">
                                <label for="customer_current_password">Mật khẩu hiện tại:</label>
                                <input type="password" class="form-control" name="customer_current_password"
                                    id="customer_current_password">
                            </div>
                            <div class="form-group">
                                <label for="customer_new_password">Mật khẩu mới:</label>
                                <input type="password" class="form-control" name="customer_new_password"
                                    id="customer_new_password">
                            </div>
                            <div class="form-group">
                                <label for="customer_re_password">Nhập lại mật khẩu mới:</label>
                                <input type="password" class="form-control" name="customer_re_password"
                                    id="customer_re_password">
                            </div>
                            <div style="clear: both"></div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-default" id="submit-password">Cập nhật</button>
                            </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
