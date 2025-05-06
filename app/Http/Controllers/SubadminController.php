<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;


class SubadminController extends Controller
{
    public function user_index()
    {
        $users = User::whereNotNull('status')->whereNotNull('role_id')->latest()->get();
        return view('user-system.user.index')->with('users',$users);
    }

    public function  system_users_index($id)
    {
     
        $roleid = Role::findOrFail($id);
       
        $users = User::whereNotNull('status')->where('role_id',$roleid->id)->latest()->get();
        return view('user-system.user.index')->with('users',$users);
    }

    public function  system_users_create()
    {
        $roles = Role::where('status',1)->get();
        
        return view('user-system.user.create')->with('roles',$roles);
    }

    public function  system_users_store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:45',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
            'password' => 'required',
            'role' => 'required',
            'city' => 'required|max:45',
            
        ]);

        if(!empty($request->image))
        {
            $data = [
              'name'=>$request->name,
              'email'=>$request->email,
              'mobile'=>$request->mobile,
              'password'=>$request->password,
              'city'=>$request->city,
              'image' =>$request->file('image')->store('images'),
              'status'=>1,
              'role_id'=>$request->role,
            ];
            User::create($data);
        }
        else
        {
            $data = [
                'name'=>$request->name,
                'email'=>$request->email,
                'mobile'=>$request->mobile,
                'password'=>$request->password,
                'city'=>$request->city,
                'status'=>1,
                'role_id'=>$request->role,
              ];
              User::create($data);
        }

        return redirect()->route('user.index')->with('success', 'System User created Successfully');
    }
    
     public function system_users_view($id)
    {
        $users = User::findOrFail($id);
        return view('user-system.user.view')->with('users',$users);

    }

    public function system_users_edit($id)
    {
        $users = User::findOrFail($id);
        $roles = Role::All();
        return view('user-system.user.create')->with('users',$users)->with('roles',$roles);

    }

    public function system_users_update(Request $request, $id)
    {
    
        
        $users = User::findOrFail($id);

        $request->validate([
            'name' => 'required|max:45',
            'email' => 'required|email',
            'mobile' => 'required|numeric',
            'role' => 'required',
            'city' => 'required|max:45',  
        ]);

        if(!empty($request->image))
        {
            $data = [
              'name'=>$request->name,
              'email'=>$request->email,
              'mobile'=>$request->mobile,
              'city'=>$request->city,
              'image' =>$request->file('image')->store('images'),
              'role_id'=>$request->role,
            ];
            $users->update($data);
        }
        else
        {
            $data = [
                'name'=>$request->name,
                'email'=>$request->email,
                'mobile'=>$request->mobile,
                'city'=>$request->city,
                'role_id'=>$request->role,
              ];
              $users->update($data);
        }

        return redirect()->route('user.index')->with('success', 'System User Updated Successfully');

    }

    public function users_active($id)
    {
        $roles = User::where('id',$id)->update(['status' =>0]);
        return redirect()->route('system_users.index');
    }

    public function users_inctive($id)
    {
        $roles = User::where('id',$id)->update(['status' =>1]);
        return redirect()->route('system_users.index');
    }

    public function user_active($id)
    {
        $roles = User::where('id',$id)->update(['status' =>0]);
        return redirect()->route('user.index');
    }

    public function user_inctive($id)
    {
        $roles = User::where('id',$id)->update(['status' =>1]);
        return redirect()->route('user.index');
    }
    
    public function sleekcare_role($id)
    {
        
        
        
    }
    
      public function sleekcare_setting()
    {
        
        $apt = ['3', '4', '5'];
        
        $setting = Setting::whereIn('id', $apt)->get();
        
    
       return view('user-system.user.setting')->with('setting',$setting);
        
    }
    
    public function sleekcare_logo(Request $request)
    { dd($request);
        
        
        $setting = Setting::findOrFail(1);
        
        
           if(!empty($request->image))
        {
            $data = [
             
              'image' =>$request->file('image')->store('images'),

            ];
            $setting->update($data);
            return redirect()->route('sleekcare.setting')->with('success', 'App logo Updated Successfully');
        }
    }
    
    
    public function sleekcare_banner(Request $request)
    {
    
    }
    
    public function sleekcare_edit($id)
    {
        $setting = Setting::findOrFail($id);
        return view('user-system.user.edit')->with('setting',$setting);
    }
        
    public function sleekcare_update(Request $request, $id)
    { 
        
 
        
          $setting = Setting::findOrFail($id);
          
    $request->validate([
        'name' => 'required|max:45',
        'discription' => 'required',
    ]);
     
        $data = [
          'name'=>$request->name,
          'discription'=>$request->discription,
       
        ];
        $setting->update($data);
  
    return redirect()->route('sleekcare.setting')->with('success', 'Setting Updated Successfully');
    }
        

    
     public function sleekcare_active($id)
    {
        $setting = Setting::where('id',$id)->update(['status' =>0]);
        return redirect()->route('sleekcare.setting');
    }
    
     public function sleekcare_inactive($id)
    {
        $setting = Setting::where('id',$id)->update(['status' =>1]);
        return redirect()->route('sleekcare.setting');
    }
        
        
}
