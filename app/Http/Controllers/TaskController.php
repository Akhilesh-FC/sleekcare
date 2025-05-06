<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{
     public function task_index()
    {
        return view('user-system.task.index');
    }
}
