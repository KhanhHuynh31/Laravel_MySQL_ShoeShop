<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\Models\Brand;
use App\Models\Product;

session_start();
class BrandProduct extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Auth::id();
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function add_brand_product()
    {
        $this->AuthLogin();
        return view('admin.add_brand_product');
    }
    public function all_brand_product()
    {
        $this->AuthLogin();
        $all_brand_product = DB::table('tbl_brand')->get();
        $manager_brand_product  = view('admin.all_brand_product')->with('all_brand_product', $all_brand_product);
        return view('admin_layout')->with('admin.all_brand_product', $manager_brand_product);
    }
    public function save_brand_product(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        $data['brand_status'] = $request->brand_product_status;

        DB::table('tbl_brand')->insert($data);
        Session::put('message', 'Thêm thương hiệu sản phẩm thành công');
        return Redirect::to('add-brand-product');
    }
    public function unactive_brand_product($brand_product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id', $brand_product_id)->update(['brand_status' => 1]);
        Session::put('message', 'Không kích hoạt thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }
    public function active_brand_product($brand_product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id', $brand_product_id)->update(['brand_status' => 0]);
        Session::put('message', 'Kích hoạt thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }
    public function edit_brand_product($brand_product_id)
    {
        $this->AuthLogin();
        $edit_brand_product = DB::table('tbl_brand')->where('brand_id', $brand_product_id)->get();

        $manager_brand_product  = view('admin.edit_brand_product')->with('edit_brand_product', $edit_brand_product);

        return view('admin_layout')->with('admin.edit_brand_product', $manager_brand_product);
    }
    public function update_brand_product(Request $request, $brand_product_id)
    {
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        DB::table('tbl_brand')->where('brand_id', $brand_product_id)->update($data);
        Session::put('message', 'Cập nhật thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }
    public function delete_brand_product($brand_product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_brand')->where('brand_id', $brand_product_id)->delete();
        Session::put('message', 'Xóa thương hiệu sản phẩm thành công');
        return Redirect::to('all-brand-product');
    }

    //End Function Admin Page

    public function show_brand_product($brand_id)
    {
        $cate_product = DB::table('tbl_category')->where('category_status', '0')->orderby('category_order', 'asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();

        $brand_name = DB::table('tbl_brand')->where('tbl_brand.brand_id', $brand_id)->limit(1)->get();

        $brand_by_id = DB::table('tbl_product')->join('tbl_brand', 'tbl_product.brand_id', '=', 'tbl_brand.brand_id')->where('tbl_brand.brand_id', $brand_id)->get();
        if (isset($_GET['sort_by'])) {

            $sort_by = $_GET['sort_by'];

            if ($sort_by == 'giam_dan') {

                $brand_by_id = Product::with('brand')->where('brand_id', $brand_id)->orderBy('product_price', 'DESC')->paginate(6)->appends(request()->query());
            } elseif ($sort_by == 'tang_dan') {

                $brand_by_id = Product::with('brand')->where('brand_id', $brand_id)->orderBy('product_price', 'ASC')->paginate(6)->appends(request()->query());
            } elseif ($sort_by == 'kytu_za') {

                $brand_by_id = Product::with('brand')->where('brand_id', $brand_id)->orderBy('product_name', 'DESC')->paginate(6)->appends(request()->query());
            } elseif ($sort_by == 'kytu_az') {

                $brand_by_id = Product::with('brand')->where('brand_id', $brand_id)->orderBy('product_name', 'ASC')->paginate(6)->appends(request()->query());
            }
        } else {
            $brand_by_id = Product::with('brand')->where('brand_id', $brand_id)->orderBy('product_id', 'DESC')->paginate(6);
        }
        return view('pages.brand.show_brand')->with('category', $cate_product)->with('brand', $brand_product)->with('brand_by_id', $brand_by_id)->with('brand_name', $brand_name);
    }
}
