@extends('admin_layout')
@section('admin_content')
<h3>Thống kê Website</h3>
<!-- //market-->
<div class="row">
    <div class="market-updates">
        <div class="col-md-4 market-update-gd">
            <div class="market-update-block clr-block-2">
                <div class="col-md-4 market-update-right">
                    <i class="fa fa-eye"> </i>
                </div>
                <div class="col-md-8 market-update-left">
                    <h4>Tài khoản khách</h4>
                    <h3>{{$all_customer}}</h3>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="col-md-4 market-update-gd">
            <div class="market-update-block clr-block-3">
                <div class="col-md-4 market-update-right">
                    <i class="fa fa-usd"></i>
                </div>
                <div class="col-md-8 market-update-left">
                    <h4>Doanh thu 7 ngày</h4>
                    <h3>{{number_format($all_order_total).' '.'VNĐ'}}</h3>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="col-md-4 market-update-gd">
            <div class="market-update-block clr-block-4">
                <div class="col-md-4 market-update-right">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </div>
                <div class="col-md-8 market-update-left">
                    <h4>Hóa đơn chưa duyệt</h4>
                    <h3>{{$all_order}}</h3>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
<!-- //market-->
<style type="text/css">
    p.title_thongke {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
    }
</style>
<div class="row">
    <p class="title_thongke">Thống kê doanh thu</p>

    <form autocomplete="off">
        @csrf
            <div class="col-md-2">
                <p>Từ ngày: <input type="text" id="datepicker" class="form-control"></p>
            </div>
            <div class="col-md-2">
                <p>Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>
            </div>
            <div class="col-md-2">
                <p><br><input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm form-control"
                        value="Lọc kết quả"></p>
            </div>
            <div class="col-md-3">
            </div>
            <div class="col-md-3">
                <p>
                    Lọc theo:
                    <select class="dashboard-filter form-control">
                        <option>--Chọn--</option>
                        <option value="7ngay">7 ngày qua</option>
                        <option value="thangtruoc">tháng trước</option>
                        <option value="thangnay">tháng này</option>
                        <option value="365ngayqua">365 ngày qua</option>
                    </select>
                </p>
            </div>
    </form>

    <div class="col-md-12">
        <div id="chart" style="height: 250px;"></div>
    </div>

</div>

<!-- //market-->
@endsection
