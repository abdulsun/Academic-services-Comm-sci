<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class directorController extends Controller
{
    public function director(){

       $director = DB::table('directors')->paginate(10);
       return view('admin.directors',compact('director'));
   }

   public function store(Request $request){
       $request->validate([
           'name'=>'required|max:255',
       ]);

      $data = array();
      $data['name'] = $request->name;
      $data['keyword'] = $request->keyword;
      $data['date_back'] = $request->date_back;
      $data['location'] = $request->location ;
      $data['year'] = $request->year;
      
      DB::table('directors')->insert($data);


       return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
   }
}
