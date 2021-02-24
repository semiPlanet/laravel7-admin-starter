<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function __construct(){
        $this->middleware('auth:admin');
    }

    public function home(){
        return view('admin.home');
    }
}
