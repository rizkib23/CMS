<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Kategori;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('home', [
            'title' => "Home",
            'posts' => $posts
        ]);
    }

    public function listKategori()
    {
        $kategoris = Kategori::all();
        return view('kategori', [
            'title' => "kategori",
            'kategoris' => $kategoris
        ]);
    }

    public function showPostByKategori($slug)
    {
        $posts = Post::publish()->whereHas('dataKategori', function ($query) use ($slug) {
            return $query->where('slug', $slug);
        })->paginate($this->perpage);

        $kategoris = Kategori::where('slug', $slug)->first();

        return view('kategori', [
            'posts' => $posts,
            'kategoris' => $kategoris,
        ]);
    }
}