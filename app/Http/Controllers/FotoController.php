<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FotoController extends Controller
{
    public function index(){
        return view('profile.show',['user']);
    }
}
