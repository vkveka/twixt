<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth')->only('home');
        $this->middleware('guest')->only('index');
    }

    public function index()
    {
        return view('index');
    }

    public function home()
    {
        return view('home');
    }
}
