<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

session_start();

class CouponController extends Controller
{
    public function unset_coupon()
    {
        $coupon = Session::get('coupon');
        if ($coupon == true) {

            Session::forget('coupon');
            return redirect()->back()->with('message', 'Xóa mã khuyến mãi thành công');
        }
    }
    public function insert_coupon()
    {
        return view('admin.coupon.insert_coupon');
    }
    public function delete_coupon($coupon_id)
    {
        DB::table('tbl_coupon')->where('coupon_id', $coupon_id)->delete();
        Session::put('message', 'Xóa mã giảm giá thành công');
        return Redirect::to('list-coupon');
    }
    public function list_coupon()
    {
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y');
        $coupon = DB::table('tbl_coupon')->orderby('coupon_id', 'DESC')->paginate(5);
        return view('admin.coupon.all_coupon')->with(compact('coupon', 'today'));
    }
    public function insert_coupon_code(Request $request)
    {
        $data = array();
        $data['coupon_name'] = $request->coupon_name;
        $data['coupon_start'] = $request->coupon_start;
        $data['coupon_end'] = $request->coupon_end;
        $data['coupon_number'] = $request->coupon_number;
        $data['coupon_code'] = $request->coupon_code;
        $data['coupon_time'] = $request->coupon_time;
        $data['coupon_condition'] = $request->coupon_condition;
        DB::table('tbl_coupon')->insert($data);
        Session::put('message', 'Thêm mã giảm giá thành công');
        return Redirect::to('insert-coupon');
    }
}
