<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PantakitController extends Controller
{
    function index(){
        return view('user.pantakit');
    }
}
