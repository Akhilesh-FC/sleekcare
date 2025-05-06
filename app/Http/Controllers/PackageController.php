<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Package;
use App\Models\Role;
use App\Models\Medicine;
class PackageController extends Controller
{
    public function package_index()
    {
        //$package = Package::latest()->get();
         $package = DB::select('SELECT packages.*, roles.name AS rname
FROM packages
LEFT JOIN roles ON packages.role_id = roles.id ORDER BY `packages`.`id` DESC;
');
        return view ('package.index')->with('package',$package);
    }
     public function medicine()
    {
       
         $package = DB::select('SELECT * FROM `medicine` WHERE 1');
        return view ('package.medicine')->with('package',$package);
    }
     public function package_create()
    {
        $role= Role::get();
        return view('package.create')->with('role',$role);
    }
     public function medicine_create()
    {
        $role= Role::get();
        return view('package.medicine_create');
    }
    public function medicine_store(Request $request)
    {
        $this->validate($request,[
          
            'name'=>'required',
            'price'=>'required',
            'slag'=>'required',
            'discount'=>'required',
            'total_price'=>'required',
            'stock'=>'required',
             'date'=>'required'
             
          ]);
            $package=new Medicine();
            $package->name =$request['name'];
            $package->price=$request['price'];
            $package->slag= $request['slag'];
            $package->discount = $request['discount'];
            $package->total_price = $request['total_price']; 
            $package->stock = $request['stock']; 
             $package->date = $request['date']; 
            // $package->status=1;
            $package->save();
            return redirect()->route('package.medicine')->with('medicine add successfully');
    }
     public function package_store(Request $request)
    {
        $this->validate($request,[
          
            'name'=>'required',
            'role_id'=>'required',
            'mrp'=>'required',
            'discount'=>'required',
            'sp'=>'required',
            'duration'=>'required'
             
          ]);
            $package=new Package();
            $package->name =$request['name'];
            $package->role_id=$request['role_id'];
            $package->mrp= $request['mrp'];
            $package->discount = $request['discount'];
            $package->sp = $request['sp']; 
            $package->duration = $request['duration']; 
            $package->status=1;
            $package->save();
            return redirect()->route('package.index')->with('package add successfully');
    }
}
