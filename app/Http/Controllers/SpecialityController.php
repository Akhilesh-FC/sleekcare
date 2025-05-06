<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Speciality;

class SpecialityController extends Controller
{
    //speciality_index

    public function speciality_index()
    {
        $speciality = Speciality::latest()->get();
        return view('speciality.index')->with('speciality',$speciality);
    }
    
     public function speciality_store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:45',
        ]);

        $data = [
          'name'=>$request->name,
          'status'=>1,
        ];
        Speciality::create($data);
        return redirect()->route('sleekcare.setting')->with('success', 'Created Successfully');
        
        return view('speciality.index');
    }
    
     public function speciality_edit($id)
    {
        $speciality = Speciality::findOrFail($id);
        return view('speciality.create')->with('speciality',$speciality);
    }
    
    public function speciality_update(Request $request,$id)
    {
        $speciality = Speciality::findOrFail($id);
        
        $request->validate([
            'name' => 'required|max:45',
        ]);

        $data = [
          'name'=>$request->name,
        ];
        $speciality->update($data);
        return redirect()->route('speciality.index')->with('success', 'Speciality Update Successfully');
        
       
    }
    
}
