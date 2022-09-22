<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Kategori;
use Illuminate\Http\Request;

class DashboarController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('permission:show_dashboard', ['only' => 'index']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::count();
        $tags = Tag::count();
        $kategoris = Kategori::count();
        return view('dashboard', [
            'title' => 'Dashboard',
            'posts' => $posts,
            'tags' => $tags,
            'kategoris' => $kategoris
        ]);
    }
}