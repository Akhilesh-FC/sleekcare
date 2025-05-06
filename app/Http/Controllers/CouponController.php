<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Coupon;
use App\Models\Package;
class CouponController extends Controller
{
    public function coupon_index()
    {
        $coupon = DB::select('SELECT coupons.*, packages.name AS pname
FROM coupons
LEFT JOIN packages ON coupons.package_id = packages.id ORDER BY `coupons`.`id` DESC;
');
        return view('coupon.index')->with('coupon',$coupon);
    }
    public function coupon_create()
    {
        $package = Package::latest()->get();
        return view('coupon.create')->with('package',$package);
    }
     public function coupon_store(Request $request)
    {
        $this->validate($request,[
          
            'code'=>'required',
            'maxoff'=>'required',
            'minpurchase'=>'required',
            'package_duration'=>'required',
            'package_id'=>'required'
             
          ]);
            $coupon=new Coupon();
            $coupon->code =$request['code'];
            $coupon->maxoff=$request['maxoff'];
            $coupon->minpurchase = $request['minpurchase'];
            $coupon->package_duration = $request['package_duration'];
            $coupon->package_id = $request['package_id']; 
            $coupon->status=1;
            $coupon->save();
            return redirect()->route('coupon.index')->with('Coupon add successfully');
    }
   
}
