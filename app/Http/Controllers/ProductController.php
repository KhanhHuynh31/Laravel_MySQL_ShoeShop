<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Imports\ProductImport;
use App\Exports\ProductExport;
use Excel;
use Auth;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Rating;
use App\Models\City;
use Toastr;
session_start();
class ProductController extends Controller
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
    public function add_product()
    {
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category')->orderby('category_order', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id', 'desc')->get();

        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product', $brand_product);
    }
    public function all_product()
    {
        $this->AuthLogin();
        $all_product = DB::table('tbl_product')
            ->join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->orderby('tbl_product.product_id', 'desc')->get();
        $manager_product  = view('admin.all_product')->with('all_product', $all_product);
        return view('admin_layout')->with('admin.all_product', $manager_product);
    }
    public function save_product(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $data['product_image'] = $request->product_status;
        $data['product_size'] = $request->product_size;
        $data['product_count'] = $request->product_count;
        $get_image = $request->file('product_image');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message', 'Th??m s???n ph???m th??nh c??ng');
            return Redirect::to('add-product');
        }
        $data['product_image'] = '';
        DB::table('tbl_product')->insert($data);
        Session::put('message', 'Th??m s???n ph???m th??nh c??ng');
        return Redirect::to('all-product');
    }
    public function unactive_product($product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 1]);
        Session::put('message', 'Kh??ng k??ch ho???t s???n ph???m th??nh c??ng');
        return Redirect::to('all-product');
    }
    public function active_product($product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 0]);
        Session::put('message', 'Kh??ng k??ch ho???t s???n ph???m th??nh c??ng');
        return Redirect::to('all-product');
    }
    public function edit_product($product_id)
    {
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category')->orderby('category_order', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id', 'desc')->get();

        $edit_product = DB::table('tbl_product')->where('product_id', $product_id)->get();

        $manager_product  = view('admin.edit_product')->with('edit_product', $edit_product)->with('cate_product', $cate_product)->with('brand_product', $brand_product);

        return view('admin_layout')->with('edit_product', $manager_product);
    }
    public function update_product(Request $request, $product_id)
    {
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image =  $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id', $product_id)->update($data);
            Session::put('message', 'C???p nh???t s???n ph???m th??nh c??ng');
            return Redirect::to('all-product');
        }

        DB::table('tbl_product')->where('product_id', $product_id)->update($data);
        Session::put('message', 'C???p nh???t s???n ph???m th??nh c??ng');
        return Redirect::to('all-product');
    }
    public function delete_product($product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->delete();
        Session::put('message', 'X??a s???n ph???m th??nh c??ng');
        return Redirect::to('all-product');
    }
    public function export_csv()
    {
        return Excel::download(new ProductExport, 'product.xlsx');
    }

    public function import_csv(Request $request)
    {
        $path = $request->file('file')->getRealPath();
        Excel::import(new ProductImport, $path);
        return back();
    }

    //End Admin Page
    public function show_product_detail($product_id)
    {
        $product_details = DB::table('tbl_product')
            ->join('tbl_category', 'tbl_category.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->where('tbl_product.product_id', $product_id)->get();

        foreach ($product_details as $key => $value) {
            $brand_id = $value->brand_id;
            $category_id = $value->category_id;
            $product_name = $value->product_name;
        }
        $city = City::orderby('matp', 'ASC')->get();
        $product_size =  DB::table('tbl_product')->where('product_name', $product_name)->orderby('product_size', 'asc')->get();

        $related_product = DB::table('tbl_product')
            ->join('tbl_category', 'tbl_product.category_id', '=', 'tbl_category.category_id')
            ->join('tbl_brand', 'tbl_product.brand_id', '=', 'tbl_brand.brand_id')
            ->where('tbl_product.product_id', '!=', $product_id)
            ->where('tbl_product.brand_id', $brand_id)
            ->where('tbl_product.category_id', $category_id)
            ->groupBy('product_name')
            ->limit(3)
            ->get();
        $rating = Rating::where('product_id', $product_id)->avg('rating');
        $rating = round($rating);
        return view('pages.product.show_details')->with('product_details', $product_details)->with('product_size', $product_size)->with('related', $related_product)->with('rating', $rating)->with('city', $city);
    }
    public function search(Request $request)
    {
        $name = $request->searchbox;
        $cate_product = DB::table('tbl_category')->where('category_status', '0')->orderby('category_order', 'asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();
        $size_product = DB::table('tbl_product')->select('product_size')->groupBy('product_size')->orderby('product_size', 'asc')->get();
        $city = City::orderby('matp', 'ASC')->get();

        $product_details = DB::table('tbl_product')->where('product_name', 'like', '%' . $name . '%')->groupBy('product_name')->paginate(6);

        return view('pages.product.search')->with('category', $cate_product)->with('brand', $brand_product)->with('size', $size_product)->with('city', $city)->with('product_details', $product_details);
    }

    public function show_product_by_size(Request $request)
    {
        $size = $request->size_value;
        $size_product = DB::table('tbl_product')->select('product_size')->groupBy('product_size')->orderby('product_size', 'asc')->get();
        $cate_product = DB::table('tbl_category')->where('category_status', '0')->orderby('category_order', 'asc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderby('brand_id', 'desc')->get();
        $city = City::orderby('matp', 'ASC')->get();
        if (isset($_GET['sort_by'])) {

            $sort_by = $_GET['sort_by'];

            if ($sort_by == 'giam_dan') {

                $product_by_size = DB::table('tbl_product')->where('product_size', 'like', '%' . $size . '%')->orderBy('product_price', 'DESC')->paginate(6)->appends(request()->query());
            } elseif ($sort_by == 'tang_dan') {

                $product_by_size = DB::table('tbl_product')->where('product_size', 'like', '%' . $size . '%')->orderBy('product_price', 'ASC')->paginate(6)->appends(request()->query());
            } elseif ($sort_by == 'kytu_za') {

                $product_by_size = DB::table('tbl_product')->where('product_size', 'like', '%' . $size . '%')->orderBy('product_name', 'DESC')->paginate(6)->appends(request()->query());
            } elseif ($sort_by == 'kytu_az') {

                $product_by_size = DB::table('tbl_product')->where('product_size', 'like', '%' . $size . '%')->orderBy('product_name', 'ASC')->paginate(6)->appends(request()->query());
            }
        } else {
            $product_by_size = DB::table('tbl_product')->where('product_size', 'like', '%' . $size . '%')->paginate(6);

        }
        return view('pages.size.show_size')->with('category', $cate_product)->with('brand', $brand_product)->with('city', $city)->with('product_by_size', $product_by_size)->with('size_name', $size)->with('size', $size_product);
    }
    public function reply_comment(Request $request)
    {
        $data = $request->all();
        $comment = new Comment();
        $comment->comment = $data['comment'];
        $comment->comment_product_id = $data['comment_product_id'];
        $comment->comment_parent_comment = $data['comment_id'];
        $comment->comment_status = 0;
        $comment->comment_name = 'Nh??n vi??n The Shoe Shop';
        $comment->save();
    }
    public function allow_comment(Request $request)
    {
        $data = $request->all();
        $comment = Comment::find($data['comment_id']);
        $comment->comment_status = $data['comment_status'];
        $comment->save();
    }
    public function list_comment()
    {
        $comment = Comment::with('product')->where('comment_parent_comment', '=', 0)->orderBy('comment_id', 'DESC')->get();
        $comment_rep = Comment::with('product')->where('comment_parent_comment', '>', 0)->get();
        return view('admin.comment.list_comment')->with(compact('comment', 'comment_rep'));
    }
    public function send_comment(Request $request)
    {
        $product_id = $request->product_id;
        $comment_name = $request->comment_name;
        $comment_content = $request->comment_content;
        $comment = new Comment();
        $comment->comment = $comment_content;
        $comment->comment_name = $comment_name;
        $comment->comment_product_id = $product_id;
        $comment->comment_status = 1;
        $comment->comment_parent_comment = 0;
        $comment->save();
    }
    public function load_comment(Request $request)
    {
        $product_id = $request->product_id;
        $comment = Comment::where('comment_product_id', $product_id)->where('comment_parent_comment', '=', 0)->where('comment_status', 0)->get();
        $comment_rep = Comment::with('product')->where('comment_parent_comment', '>', 0)->get();
        $output = '';
        foreach ($comment as $key => $comm) {
            $output .= '
            <div class="row style_comment">

                                        <div class="col-md-2">
                                            <img width="100%" src="' . url('/public/frontend/images/product-details/avatar.png') . '" class="img img-responsive img-thumbnail">
                                        </div>
                                        <div class="col-md-10">
                                            <p style="color:green;">@' . $comm->comment_name . '</p>
                                            <p style="color:#000;">' . $comm->comment_date . '</p>
                                            <p>' . $comm->comment . '</p>
                                        </div>
                                    </div><p></p>
                                    ';

            foreach ($comment_rep as $key => $rep_comment) {
                if ($rep_comment->comment_parent_comment == $comm->comment_id) {
                    $output .= ' <div class="row style_comment" style="margin:5px 40px;background: aquamarine;">

                                        <div class="col-md-2">
                                            <img width="80%" src="' . url('/public/frontend/images/businessman.jpg') . '" class="img img-responsive img-thumbnail">
                                        </div>
                                        <div class="col-md-10">
                                            <p style="color:blue;">@Admin</p>
                                            <p style="color:#000;">' . $rep_comment->comment . '</p>
                                            <p></p>
                                        </div>
                                    </div><p></p>';
                }
            }
        }
        echo $output;
    }
    public function insert_rating(Request $request)
    {
        $data = $request->all();
        $rating = new Rating();
        $rating->product_id = $data['product_id'];
        $rating->rating = $data['index'];
        $rating->save();
        echo 'done';
    }

    public function favorite_product(Request $request)
    {
        $data = $request->all();
        $product_id = $data['id'];
        $customer_id = Session::get('customer_id');
        $fav_product = DB::table('tbl_favorite')->where('customer_id', '=', $customer_id)->where('product_id', '=', $product_id)->count();
        if ($fav_product > 0) {
            echo 'B???n ???? y??u th??ch s???n ph???m n??y';
        } else if ($customer_id != "") {
            $data = array();
            $data['product_id'] =  $product_id;
            $data['customer_id'] =  $customer_id;
            DB::table('tbl_favorite')->insert($data);
            echo 'Y??u th??ch s???n ph???m th??nh c??ng';

        } else {
            echo 'B???n ch??a ????ng nh???p';
        }
    }

    public function show_favorite_product()
    {
        $city = City::orderby('matp', 'ASC')->get();
        $customer_id = Session::get('customer_id');
        $fav_product = DB::table('tbl_favorite')
            ->join('tbl_product', 'tbl_product.product_id', '=', 'tbl_favorite.product_id')
            ->where('tbl_favorite.customer_id', '=', $customer_id)
            ->orderby('tbl_favorite.favorite_id', 'desc')->paginate(6);
        return view('pages.favorite.show_favorite')->with('fav_product', $fav_product)->with('city', $city);
    }
}
