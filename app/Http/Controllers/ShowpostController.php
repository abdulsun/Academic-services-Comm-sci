<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\posts;

class ShowpostController extends Controller
{
    public function index(){
        //$lucture = lucture::all();
        //$lucture = lucture::paginate(1);
       $showpost = DB::table('posts')
       ->join('users','posts.admin','admin')
       ->select('posts.*','users.name')->get();
       //$lucture = DB::table('luctures')->paginate(1);
       return view('user.showpost',compact('showpost'));
   }
}
