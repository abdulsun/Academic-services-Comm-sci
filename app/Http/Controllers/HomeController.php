<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index(){
        $city = "pattani, yala, narathiwat";
        $tell = "0630856324";
        
       // return view('home',['city'=>$city],['tell'=>$tell]);
       // return view('home',compact('city','tell'));
        return view('user.home')
        ->with('city',$city)
        ->with('tell',$tell)
        ->with('error','404 not found หาข้อมูไม่เจอ');
    }

    function showDate(){
        echo "";
    }
}
