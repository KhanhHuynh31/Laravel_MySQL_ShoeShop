@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">

    <div class="panel panel-default">
        <div class="panel-heading">
            Thông tin khách hàng
        </div>
        <div class="table-responsive">
            <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>

                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>

                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>

                    <tr>

                        <td>{{$customer->customer_name}}</td>
                        <td>{{$customer->customer_phone}}</td>
                        <td>{{$customer->customer_email}}</td>


                    </tr>

                </tbody>
            </table>

        </div>

    </div>
</div>
<br>
<div class="table-agile-info">

    <div class="panel panel-default">
        <div class="panel-heading">
            Thông tin vận chuyển
        </div>


        <div class="table-responsive">
            <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>

                        <th>Tên người nhận hàng</th>
                        <th>Địa chỉ</th>
                        <th>Số điện thoại</th>
                        <th>Email</th>
                        <th>Ghi chú</th>
                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>

                    <tr>

                        <td>{{$shipping->shipping_name}}</td>
                        <td>{{$shipping->shipping_address}}</td>
                        <td>{{$shipping->shipping_phone}}</td>
                        <td>{{$shipping->shipping_email}}</td>
                        <td>{{$shipping->shipping_notes}}</td>



                    </tr>

                </tbody>
            </table>

        </div>

    </div>
</div>
<br><br>
<div class="table-agile-info">

    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê chi tiết đơn hàng
        </div>
        <div class="row w3-res-tb">
            <div class="col-sm-5 m-b-xs">
                <select class="input-sm form-control w-sm inline v-middle">
                    <option value="0">Bulk action</option>
                    <option value="1">Delete selected</option>
                    <option value="2">Bulk edit</option>
                    <option value="3">Export</option>
                </select>
                <button class="btn btn-sm btn-default">Apply</button>
            </div>
            <div class="col-sm-4">
            </div>
            <div class="col-sm-3">
                <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="Search">
                    <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng tiền</th>

                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order_details_product as $key => $order)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                        <td>{{$order->product_name }}</td>
                        <td>{{$order->product_quantity }}</td>
                        <td>{{$order->product_price}}</td>
                        <td>{{$order->product_price*$order->product_quantity }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="order-coupon">
            @foreach($getorder as $key => $total)
            <p>Giá gốc: {{number_format($total->order_total).' '.'VNĐ'}}</p>
            @if( $total->coupon_total != 0)
            <p>Giảm từ Coupon: {{number_format($total->order_total - $total->coupon_total).' '.'VNĐ'}} </p>
            <p>Phí ship: {{number_format($total->order_fee).' '.'VNĐ'}}</p>
            <hr>
            <p>Tổng tiền: {{number_format($total->coupon_total+$total->order_fee).' '.'VNĐ'}}</p>
            @else
            <p>Phí ship: {{number_format($total->order_fee).' '.'VNĐ'}}</p>
            <hr>
            <p>Tổng tiền: {{number_format($total->order_total+$total->order_fee).' '.'VNĐ'}}</p>
            @endif
            @endforeach

            @foreach($getorder as $key => $or)
            <form action="{{URL::to('/update-order/'.$or->order_id)}}" method="post">
                @csrf
                <p>Tình trạng: {{$or->order_status}}</p>
                <select class="form-control" name="order_status">
                    <option value="0">Chưa xử lý</option>
                    <option value="1">Đã nhận</option>
                    <option value="2">Đang giao hàng</option>
                    <option value="3">Đã thanh toán</option>
                    <option value="4">Huỷ đơn</option>
                </select>
                <button type="submit" name="order_update" class="btn btn-info">Cập nhật</button>
            </form>
            @endforeach
        </div>
        <a target="_blank" href="{{url('/print-order/'.$order->order_id)}}">In hoá đơn</a>

    </div>
</div>

@endsection
