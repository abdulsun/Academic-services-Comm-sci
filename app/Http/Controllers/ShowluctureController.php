<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShowluctureController extends Controller
{
    public function index(){
       $lucture = DB::table('luctures')->get();
       return view('user.showlucture',compact('lucture'));
   }
}
