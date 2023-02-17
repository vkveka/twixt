<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
// use Illuminate\Routing\Controller;
// use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

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
        $posts = Post::latest()->paginate(10);
        return view('home', compact('posts'));
    }
}
