@extends('layout')
@section('content')
<div class="jumbotron text-center">
    <h2 class="display-3">Thanh toán PayPal</h2>
    @php
    $vnd_to_usd = $order_total_paypal/22000;
    @endphp
    <input type="hidden" id="paypal_total" value="{{round($vnd_to_usd,2)}}">
    <p class="lead"><strong>Vui lòng click vào nút thanh toán</strong> để thực hiện thanh toán bằng PayPal</p>
    <p class="lead">
        <div id="paypal-button"></div>
    </p>
</div>
@endsection
