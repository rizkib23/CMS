<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Kategori;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $posts = Post::publish()->latest()->paginate();
        $pengumuman = Pengumuman::orderBy('id', 'desc')->get();
        return view('home', [
            'title' => "Home",
            'posts' => Post::publish()->latest()->paginate($this->perpage)
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

    public function searchPosts(Request $request)
    {
        if ($request->get('keyword')) {
            return redirect()->route('home');
        }
        return view('search-post', [
            'posts' => Post::Publish()->search($request->keyword)
                ->paginate($this->perpage)
                ->appends(['keyword' => $request->keyword])
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

    public function showPostDetail($slug)
    {
        $posts = Post::where('slug', $slug)->first();
        if (!$posts) {
            return redirect()->route('home');
        }
        return view('post-detail', [
            'posts' => $posts
        ]);
    }
}