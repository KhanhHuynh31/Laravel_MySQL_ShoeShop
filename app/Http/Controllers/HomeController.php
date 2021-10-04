<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        $cate_product = DB::table('tbl_category')->where('category_status', '0')->orderby('category_order', 'asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();
        $hot_product = DB::table('tbl_product')->where('product_status', '0')->groupBy('product_name')->orderby('product_like', 'desc')->limit(6)->get();
        $new_product = DB::table('tbl_product')->where('product_status', '0')->groupBy('product_name')->orderby('product_id', 'desc')->limit(10)->get();
        $city = City::orderby('matp', 'ASC')->get();
        return view('pages.home')->with('category', $cate_product)->with('brand', $brand_product)->with('hot_product', $hot_product)->with('new_product', $new_product)->with('city', $city);
    }
    public function autocomplete_ajax(Request $request)
    {
        $data = $request->all();

        if ($data['query']) {

            $product = DB::table('tbl_product')->where('product_status', 0)->where('product_name', 'LIKE', '%' . $data['query'] . '%')->get();

            $output = '
            <ul class="dropdown-menu" style="display:block; position:relative">';

            foreach ($product as $key => $val) {
                $output .= '
               <li class="li_search_ajax"><a href="#">' . $val->product_name . '</a></li>
               ';
            }

            $output .= '</ul>';
            echo $output;
        }
    }
}
