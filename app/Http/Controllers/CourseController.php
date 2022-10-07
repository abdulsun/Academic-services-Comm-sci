<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    function index(){
        $news = DB::table('news')->get();
        return view('user.course',compact('news'));
    }
}
