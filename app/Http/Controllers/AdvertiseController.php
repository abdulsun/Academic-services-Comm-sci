<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\posts;

class AdvertiseController extends Controller
{
    public function index(){
       $post = DB::table('posts')->get();
       //$lucture = DB::table('luctures')->paginate(1);
       return view('user.advertise',compact('post'));
   }
   public function show($id){
        $posts = posts::find($id);
        return view('user.advertiseshow',compact('posts'));
    }
}
