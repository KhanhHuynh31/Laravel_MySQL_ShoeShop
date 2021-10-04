<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\Models\Category;
use App\Models\Product;
use App\Models\City;


session_start();

class CategoryProduct extends Controller
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
    public function add_category_product()
    {
        $this->AuthLogin();
        $all_category = DB::table('tbl_category')->get();
        return view('admin.add_category_product')->with('all_category', $all_category);
    }
    public function all_category_product()
    {
        $this->AuthLogin();
        $category_product = Category::where('category_parent', 0)->orderBy('category_order', 'ASC')->get();

        $all_category_product = DB::table('tbl_category')->orderBy('category_order', 'ASC')->get();
        $manager_category_product  = view('admin.all_category_product')->with('all_category_product', $all_category_product)->with('category_product', $category_product);
        return view('admin_layout')->with('admin.all_category_product', $manager_category_product);
    }
    public function save_category_product(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_parent'] = $request->category_parent;
        $data['category_status'] = $request->category_product_status;

        DB::table('tbl_category')->insert($data);
        Session::put('message', 'Thêm danh mục sản phẩm thành công');
        return Redirect::to('add-category-product');
    }
    public function unactive_category_product($category_product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_category')->where('category_id', $category_product_id)->update(['category_status' => 1]);
        Session::put('message', 'Không kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function active_category_product($category_product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_category')->where('category_id', $category_product_id)->update(['category_status' => 0]);
        Session::put('message', 'Kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function edit_category_product($category_product_id)
    {
        $this->AuthLogin();
        $edit_category_product = DB::table('tbl_category')->where('category_id', $category_product_id)->get();

        $manager_category_product  = view('admin.edit_category_product')->with('edit_category_product', $edit_category_product);

        return view('admin_layout')->with('admin.edit_category_product', $manager_category_product);
    }
    public function update_category_product(Request $request, $category_product_id)
    {
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        DB::table('tbl_category')->where('category_id', $category_product_id)->update($data);
        Session::put('message', 'Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function delete_category_product($category_product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_category')->where('category_id', $category_product_id)->delete();
        Session::put('message', 'Xóa danh mục sản phẩm thành công');
        return Redirect::to('all-category-product');
    }
    public function arrange_category(Request $request)
    {

        $this->AuthLogin();

        $data = $request->all();
        $cate_id = $data["page_id_array"];

        foreach ($cate_id as $key => $value) {
            $category = Category::find($value);
            $category->category_order = $key;
            $category->save();
        }
        echo 'Updated';
    }
    //End Function Admin Page
    public function show_category_product($category_id)
    {
        $cate_product = DB::table('tbl_category')->where('category_status', '0')->orderby('category_order', 'asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();
        $category_name = DB::table('tbl_category')->where('tbl_category.category_id', $category_id)->limit(1)->get();
        $city = City::orderby('matp', 'ASC')->get();

        if (isset($_GET['sort_by'])) {

            $sort_by = $_GET['sort_by'];

            if ($sort_by == 'giam_dan') {

                $category_by_id = Product::with('category')->where('category_id', $category_id)->groupBy('product_name')->orderBy('product_price', 'DESC')->paginate(6)->appends(request()->query());
            } elseif ($sort_by == 'tang_dan') {

                $category_by_id = Product::with('category')->where('category_id', $category_id)->groupBy('product_name')->orderBy('product_price', 'ASC')->paginate(6)->appends(request()->query());
            } elseif ($sort_by == 'kytu_za') {

                $category_by_id = Product::with('category')->where('category_id', $category_id)->groupBy('product_name')->orderBy('product_name', 'DESC')->paginate(6)->appends(request()->query());
            } elseif ($sort_by == 'kytu_az') {

                $category_by_id = Product::with('category')->where('category_id', $category_id)->groupBy('product_name')->orderBy('product_name', 'ASC')->paginate(6)->appends(request()->query());
            }
        } else {
            $category_by_id = Product::with('category')->where('category_id', $category_id)->groupBy('product_name')->orderBy('product_id', 'DESC')->paginate(6);
        }
        return view('pages.category.show_category')->with('category', $cate_product)->with('brand', $brand_product)->with('category_by_id', $category_by_id)->with('category_name', $category_name)->with('city', $city);
    }
}
