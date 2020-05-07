<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::paginate(2);
        $categories = Category::all();

        return view('home', compact('posts', 'categories'));
    }

    public function post($slug) {
        $post = Post::findBySlugOrFail($slug);
        $categories = Category::all();
        // get all approved comments
        $comments = $post->comments()->whereIsActive(1)->get();

        return view('post', compact('post', 'comments', 'categories'));

    }
}
