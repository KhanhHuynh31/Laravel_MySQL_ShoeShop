@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê mã giảm giá
        </div>
        <div class="table-responsive">
            <?php
      $message = Session::get('message');
      if($message){
        echo '<span class="text-alert">'.$message.'</span>';
        Session::put('message',null);
      }
      ?>
            <table id="myTable" class="table table-striped b-t b-light">
                <thead>
                    <tr>


                        <th>Tên mã giảm giá</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày kết thúc</th>
                        <th>Mã giảm giá</th>
                        <th>Số lượng giảm giá</th>
                        <th>Điều kiện giảm giá</th>
                        <th>Số giảm</th>
                        <th>Tình trạng</th>
                        <th>Hết hạn</th>
                        <td>Quản lý</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($coupon as $key => $cou)
                    <tr>

                        <td>{{ $cou->coupon_name }}</td>
                        <td>{{ $cou->coupon_start }}</td>
                        <td>{{ $cou->coupon_end }}</td>

                        <td>{{ $cou->coupon_code }}</td>
                        <td>{{ $cou->coupon_time }}</td>
                        <td><span class="text-ellipsis">
                                <?php
              if($cou->coupon_condition==1){
                ?>
                                Giảm theo %
                                <?php
              }else{
                ?>
                                Giảm theo tiền
                                <?php
              }
              ?>
                            </span>
                        </td>
                        <td><span class="text-ellipsis">
                                <?php
            if($cou->coupon_condition==1){
              ?>
                                Giảm {{$cou->coupon_number}} %
                                <?php
            }else{
              ?>
                                Giảm {{$cou->coupon_number}} k
                                <?php
            }
            ?>
                            </span></td>

                        <td><span class="text-ellipsis">
                                <?php
                                if($cou->coupon_status==1){
                                ?>
                                <a href="{{URL::to('/unactive-coupon-product/'.$cou->coupon_id)}}"><span
                                        class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                                <?php
                                }else{
                                ?>
                                <a href="{{URL::to('/active-coupon-product/'.$cou->coupon_id)}}"><span
                                        class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                                <?php
                                }
                                ?>
                            </span></td>
                        <td>

                            @if($cou->coupon_end>=$today)
                            <span style="color:green">Còn hạn</span>
                            @else
                            <span style="color:red">Đã hết hạn</span>
                            @endif


                        </td>
                        <td>

                            <a onclick="return confirm('Bạn có chắc là muốn xóa mã này ko?')"
                                href="{{URL::to('/delete-coupon/'.$cou->coupon_id)}}" class="active styling-edit"
                                ui-toggle-class="">
                                <i class="fa fa-times text-danger text"></i>
                            </a>
                        </td>
                        {{-- <td>

                            <p><a href="{{url('/send-coupon-vip', [

            'coupon_time'=> $cou->coupon_time,
            'coupon_condition'=> $cou->coupon_condition,
            'coupon_number'=> $cou->coupon_number,
            'coupon_code'=> $cou->coupon_code


          ])}}" class="btn btn-primary" style="margin:5px 0;">Gửi giảm giá khách vip</a></p>
                            <p><a href="{{url('/send-coupon',[


            'coupon_time'=> $cou->coupon_time,
            'coupon_condition'=> $cou->coupon_condition,
            'coupon_number'=> $cou->coupon_number,
            'coupon_code'=> $cou->coupon_code


          ])}}" class="btn btn-default">Gửi giảm giá khách thường</a></p>


                        </td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
