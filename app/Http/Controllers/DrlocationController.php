<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Drlocation;

class DrlocationController extends Controller
{
    public function dl_index()
    {
        $drlocation = Drlocation::latest()->get();
        return view('doctor_location.index')->with('drlocation',$drlocation);
    }
}
