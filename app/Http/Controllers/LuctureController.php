<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\lucture;
use Illuminate\Support\Facades\DB;

class LuctureController extends Controller
{
    public function lucture(){
         //$lucture = lucture::all();
         //$lucture = lucture::paginate(1);
        //$lucture = DB::table('luctures')->get();
        $lucture = DB::table('luctures')->paginate(5);
        return view('admin.lucture',compact('lucture'));
    }

    public function store(Request $request){
        $request->validate([
            'lucture_year'=>'required|max:255',
        ]);

    /*    dd($request->lucture_year );
        dd($request->lucture_keyword );
        dd($request->lucture_name );
        dd($request->lucture_project );
        dd($request->lucture_date_start );
        dd($request->lucture_date_end );
        dd($request->lucture_location );  */

        //บันทึกข้อมูล

        $lucture = new lucture;
        $lucture->year = $request->lucture_year;
        $lucture->keyword = $request->lucture_keyword ;
        $lucture->lucture_name = $request->lucture_name ;
        $lucture->project_name = $request->lucture_project ;
        $lucture->date_start = $request->lucture_date_start ;
        $lucture->date_end = $request->lucture_date_end ;
        $lucture->	location = $request->lucture_location ;
        $lucture->save();
/*
        $data["user_id] = Auth::user()->id;

        $data = array();
       $data['year'] = $request->lucture_year;
       $data['keyword'] = $request->lucture_keyword;
       $data['lucture_name'] = $request->lucture_name;
       $data['project_name'] = $request->lucture_project;
       $data['date_start'] = $request->lucture_date_start;
       $data['date_end'] = $request->lucture_date_end;
       $data['location'] = $request->lucture_location ;

       DB::table('lucture')->insert($data);
*/

        return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");
    }
}
