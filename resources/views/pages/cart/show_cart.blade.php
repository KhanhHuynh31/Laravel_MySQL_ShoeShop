@extends('layout')
@section('content')
<div class="breadcrumbs">
    <ol class="breadcrumb">
        <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
        <li class="active">Giỏ hàng của bạn</li>
    </ol>
</div>
<section id="cart_items">
    <div class="container">
        <div class="table-responsive cart_info">
            <?php
				$content = Cart::content();
				?>
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình ảnh</td>
                        <td class="description">Tên sản phẩm</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng tiền</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($content as $v_content)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="{{URL::to('public/uploads/product/'.$v_content->options->image)}}"
                                    width="90" alt="" /></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$v_content->name}}</a></h4>
                            <p>Size: 23</p>
                        </td>
                        <td class="cart_price">
                            <p>{{number_format($v_content->price).' '.'VNĐ'}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <form action="{{URL::to('/update-cart-quantity')}}" method="POST">
                                    {{ csrf_field() }}
                                    <input class="cart_quantity_input" type="number" name="cart_quantity"
                                        value="{{$v_content->qty}}">
                                    <input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart"
                                        class="form-control">
                                    <input type="submit" value="Cập nhật" name="update_qty"
                                        class="btn btn-default btn-sm">
                                </form>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">

                                <?php
									$subtotal = $v_content->price * $v_content->qty;
									echo number_format($subtotal).' '.'VNĐ';
									?>
                            </p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}"><i
                                    class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
<!--/#cart_items-->

<section id="do_action">
    <div class="container">
        @if (Cart::totalFloat()!=0)
        <div class="row">
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Tổng tiền:<span>{{number_format(Cart::totalFloat()/1.21).' '.'VNĐ'}}</span></li>
                        <li>Phí vận chuyển:<span>Miễn phí</span></li>
                        <li>Mã giảm giá:
                            <form method="POST" action="{{url('/check-coupon')}}">
                                @csrf
                                <input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá">
                                <input type="submit" name="check_coupon" value="Áp dụng"
                                    class="applysales btn btn-default">
                            </form>
                        </li>
                        @if(session()->has('message'))
                        <li>
                            <div class="alert alert-success">
                                {!! session()->get('message') !!}
                            </div>
                            @if(Session::get('coupon'))
                        <li>
                            @foreach(Session::get('coupon') as $key => $cou)
                            @if($cou['coupon_condition']==1)
                            Tiết kiệm: {{$cou['coupon_number']}} %
                            <p>
                                @php
                                $total=Cart::totalFloat()/1.21;
                                $total_coupon = ($total*$cou['coupon_number'])/100;
                                Session::put('total_coupon',$total_coupon);
                                @endphp
                            </p>
                            <p>
                        <li>Tổng sau khi đã giảm :{{number_format($total_coupon).' '.'VNĐ'}}</li>
                        </p>
                        @elseif($cou['coupon_condition']==2)
                        Tiết kiệm: {{number_format($cou['coupon_number']).' '.'VNĐ'}}
                        <p>
                            @php
                            $total=Cart::totalFloat()/1.21;
                            $total_coupon = $total - $cou['coupon_number'];
                            Session::put('total_coupon', $total_coupon);
                            @endphp
                        </p>
                        <p>
                            <li>Tổng sau khi đã giảm :{{number_format($total_coupon).' '.'VNĐ'}}</li>
                        </p>
                        @endif
                        @endforeach

                        @endif

                        @elseif(session()->has('error'))
                        <li>
                            <div class="alert alert-danger">
                                {!! session()->get('error') !!}
                            </div>
                        </li>
                        @endif

                        <hr>


                    </ul>
                    <?php
                                   $customer_id = Session::get('customer_id');
                                   if($customer_id!=NULL){
                                 ?>

                    <a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Thanh toán ngay</a>
                    <?php
                            }else{
                                 ?>

                    <a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Đăng nhập và thanh
                        toán</a>
                    <?php
                             }
                                 ?>
                </div>
            </div>

        </div>
        @else
        <p>Bạn chưa mua hàng</p>
        @endif

    </div>
</section>
<!--/#do_action-->


@endsection
