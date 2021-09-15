<style type="text/css">
    ul.nav.nav-pills.nav-style-li li {
        border: 1px solid #ddd;
        border-radius: 5px;
        margin: 2px 5px;
    }
</style>
<div class="left-sidebar">
    <h2>Danh mục sản phẩm</h2>
    <div class="panel-group category-products" id="accordian">
        <!--category-productsr-->

        @foreach($category as $key => $cate)
        <div class="panel panel-default">

            @if($cate->category_parent==0)
            <div class="panel-heading">
                <h4 class="panel-title">

                    <a data-toggle="collapse" data-parent="#accordian" href="#{{$cate->category_id}}">
                        <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                        <a href="{{URL::to('/category-detail/'.$cate->category_id)}}">{{$cate->category_name}}</a>
                    </a>

                </h4>
            </div>

            <div id="{{$cate->category_id}}" class="panel-collapse collapse">
                <div class="panel-body">
                    <ul>
                        @foreach($category as $key => $cate_sub)
                        @if($cate_sub->category_parent==$cate->category_id)
                        <li class="sub__category" >
                            <a href="{{URL::to('/category-detail/'.$cate_sub->category_id)}}">{{$cate_sub->category_name}}</a>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif



        </div>


        @endforeach

    </div>
    <!--/category-products-->

    <div class="brands_products">
        <!--brands_products-->
        <h2>Brands</h2>
        <div class="brands-name">
            <ul class="nav nav-pills nav-stacked">
                @foreach($brand as $key => $br)
                <li><a href="{{URL::to('/brand-detail/'.$br->brand_id)}}">{{$br->brand_name}}</a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    <!--/brands_products-->
    <div class="brands_products">
        <h2>Size</h2>
        <div class="brands-name ">
            <ul class="nav nav-pills nav-style-li">
                <li><a href="#">30</a></li>

            </ul>

        </div>
    </div>

</div>
