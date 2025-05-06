<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function role_index()
    {
        $roles =  Role::all();
        return view('role.index')->with('roles',$roles);
    }

    public function role_create()
    {
        $roles =  Role::all();
        return view ('role.role')->with('roles',$roles);
    }

    public function role_store(Request $request)
    {   
        $request->validate([
            'name' => 'required|max:45',
        ]);

        $data = [
          'name'=>$request->name,
          'status'=>1,
        ];
        Role::create($data);
        return redirect()->route('role.create')->with('success', 'Role created Successfully');

    }

    public function role_active($id)
    {
        $roles = Role::where('id',$id)->update(['status' =>0]);
        return redirect()->route('role.create');
    }

    public function role_inctive($id)
    {
        $roles = Role::where('id',$id)->update(['status' =>1]);
        return redirect()->route('role.create');
    }

    public function role_edit($id)
    {
        $roless = Role::findOrFail($id);

        return view ('role.role')->with('roless',$roless);
    }

    public function role_update(Request $request, $id)
    {
        $roles = Role::findOrFail($id);

        $request->validate([
            'name' => 'required|max:45',
        ]);

        $data = [
          'name'=>$request->name,
        ];
        $roles->update($data);
        return redirect()->route('role.create')->with('success', 'Role Updated Successfully');
    }

    public function rp_index()
    {
        $roles =  Role::all();
        return view ('role.create')->with('roles',$roles);
    }

    public function rp_store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:45',
        ]);

        $id = $request->name;

        $roles = Role::where('id',$id)->update(['permissionid' =>$request->permissionid]);
        return redirect()->route('role.index');
    }


}

