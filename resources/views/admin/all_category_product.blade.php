@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Liệt kê danh mục sản phẩm
        </div>
        <div class="table-responsive">
            <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
            <style type="text/css">
                #category_order .ui-state-highlight {
                    padding: 24px;
                    background-color: #ececec;
                    border: 1px dotted #ccc;
                    cursor: move;
                    margin-top: 12px;
                }
            </style>
            <table class="table table-striped b-t b-light" id="myTable">
                <thead>
                    <tr>
                        <th>Thứ tự</th>
                        <th>Tên danh mục</th>
                        <th>Thuộc danh mục</th>
                        <th>Mô tả</th>
                        <th>Hiển thị</th>
                        <th>Xử lí</th>
                    </tr>
                </thead>
                <tbody id="category_order">

                    @foreach($all_category_product as $key => $cate_pro)
                    <tr id="{{$cate_pro->category_id}}">
                        <td>{{ $cate_pro->category_order }}</td>
                        <td>{{ $cate_pro->category_name }}</td>
                        <td>
                            @if($cate_pro->category_parent==0)
                            <span style="color:red;">Danh mục cha</span>

                            @else

                            @foreach($category_product as $key => $cate_sub_pro)

                            @if($cate_sub_pro->category_id==$cate_pro->category_parent)
                            <span style="color:green;">{{$cate_sub_pro->category_name}}</span>
                            @endif

                            @endforeach

                            @endif
                        </td>
                        <td>{{ $cate_pro->category_desc }}</td>
                        <td><span class="text-ellipsis">
                                <?php
                         if($cate_pro->category_status==0){
                          ?>
                                <a href="{{URL::to('/unactive-category-product/'.$cate_pro->category_id)}}"><span
                                        class="fa-thumb-styling fa fa-thumbs-up"></span></a>
                                <?php
                           }else{
                          ?>
                                <a href="{{URL::to('/active-category-product/'.$cate_pro->category_id)}}"><span
                                        class="fa-thumb-styling fa fa-thumbs-down"></span></a>
                                <?php
                         }
                        ?>
                            </span></td>

                        <td>
                            <a href="{{URL::to('/edit-category-product/'.$cate_pro->category_id)}}"
                                class="active styling-edit" ui-toggle-class="">
                                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                            <a onclick="return confirm('Bạn có chắc là muốn xóa danh mục này ko?')"
                                href="{{URL::to('/delete-category-product/'.$cate_pro->category_id)}}"
                                class="active styling-edit" ui-toggle-class="">
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
