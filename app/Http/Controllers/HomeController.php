<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        $cate_product = DB::table('tbl_category')->where('category_status', '0')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();
        $hot_product = DB::table('tbl_product')->where('product_status', '0')->orderby('product_like', 'desc')->limit(6)->get();
        $new_product = DB::table('tbl_product')->where('product_status', '0')->orderby('product_id', 'desc')->limit(3)->get();

        return view('pages.home')->with('category', $cate_product)->with('brand', $brand_product)->with('hot_product', $hot_product)->with('new_product', $new_product);
    }
}
