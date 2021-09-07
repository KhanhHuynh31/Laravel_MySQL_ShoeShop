@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê đơn hàng
        </div>
        <div class="table-responsive">
            <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
            <table class="table table-striped b-t b-light" id="myTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên người đặt</th>
                        <th>Ngày đặt</th>
                        <th>Tổng giá tiền</th>
                        <th>Tình trạng</th>
                        <th>Xử lí</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($all_order as $key => $order)
                    <tr>
                        <td>{{ $order->order_id }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->order_date }}</td>
                        @if( $order->coupon_total != 0)
                        <td>{{ number_format($order->order_total - $order->coupon_total + $order->order_fee).' '.'VNĐ'}}
                            @else
                        <td>{{ number_format($order->order_total + $order->order_fee).' '.'VNĐ'}}
                            @endif
                        </td>
                        <td>{{ $order->order_status }}</td>

                        <td>
                            <a href="{{URL::to('/view-order/'.$order->order_id)}}" class="active styling-edit"
                                ui-toggle-class="">
                                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                            <a onclick="return confirm('Bạn có chắc là muốn xóa đơn hàng không?')"
                                href="{{URL::to('/delete-order/'.$order->order_id)}}" class="active styling-edit"
                                ui-toggle-class="">
                                <i class="fa fa-times text-danger text"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
