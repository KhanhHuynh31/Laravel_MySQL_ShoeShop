@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê sản phẩm
        </div>
        <div class="row w3-res-tb">
            <div class="col-sm-5 m-b-xs">

                <form action="{{url('import-csv')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" accept=".xlsx"><br>
                    <input type="submit" value="Import CSV" name="import_csv" class="btn btn-warning">
                </form>
                <form action="{{url('export-csv')}}" method="POST">
                    @csrf
                    <input type="submit" value="Export CSV" name="export_csv" class="btn btn-success">
                </form>
                <button class="btn btn-sm btn-default">Apply</button>
            </div>
            <div class="col-sm-4">
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
            <table class="table table-striped b-t b-light myTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Hình sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Thương hiệu</th>
                        <th>Giá</th>
                        <th>Nổi bật</th>
                        <th>Xử lí</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all_product as $key => $pro)
                    <tr>
                        <td>{{ $pro->product_id }}</td>
                        <td><img src="public/uploads/product/{{ $pro->product_image }}" height="100" width="100"></td>
                        <td>{{ $pro->product_name }}</td>
                        <td>{{ $pro->category_name }}</td>
                        <td>{{ $pro->brand_name }}</td>
                        <td>{{ $pro->product_price }}</td>
                        <td><span class="text-ellipsis">
                                <?php
               if($pro->product_status==0){
                ?>
                                <a href="{{URL::to('/unactive-product/'.$pro->product_id)}}"><span
                                        class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                                <?php
                 }else{
                ?>
                                <a href="{{URL::to('/active-product/'.$pro->product_id)}}"><span
                                        class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                                <?php
               }
              ?>
                            </span></td>

                        <td>
                            <a href="{{URL::to('/edit-product/'.$pro->product_id)}}" class="active styling-edit"
                                ui-toggle-class="">
                                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                            <a onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm này ko?')"
                                href="{{URL::to('/delete-product/'.$pro->product_id)}}" class="active styling-edit"
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
