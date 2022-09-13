<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Kategori;
use App\Models\Komentar;
use App\Models\Pengumuman;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $perpage = 10;
    public function home()
    {
        $posts = Post::all();
        $pengumuman = Pengumuman::orderBy('created_at', 'desc')->get();
        return view('home', [
            'title' => "Home",
            'posts' => Post::publish()->latest()->paginate($this->perpage),
            'notif' => Pengumuman::orderBy('id', 'desc')->get(),
            'tag' => Tag::all(),
        ]);
    }

    public function listKategori()
    {
        $kategoris = Kategori::all();
        return view('kategori', [
            'title' => "Kategori",
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
                // ->paginate($this->perpage)
                ->appends(['keyword' => $request->keyword])
        ]);
    }

    public function showPostByKategori($slug)
    {
        $posts = Post::publish()->whereHas('dataKategori', function ($query) use ($slug) {
            return $query->where('slug', $slug);
        });

        $kategoris = Kategori::where('slug', $slug)->first();

        return view('kategori', [
            'posts' => $posts,
            'kategoris' => $kategoris,
        ]);
    }

    public function showPostDetail($slug)
    {

        $posts = Post::where('slug', $slug)->first();
        $komen = Komentar::all();
        if (!$posts) {
            return redirect()->route('home');
        }
        // dd($posts->judul);
        return view('post-detail', [
            'posts' => $posts,
            'title' => $posts->judul,
            'komen' => $komen
        ]);
    }

    public function showPostByTag($slug)
    {
        $posts = Post::publish()->whereHas('dataTags', function ($query) use ($slug) {
            return $query->where('slug', $slug);
        })->paginate($this->perpage);

        $tag = Tag::where('slug', $slug)->first();
        $tags = Tag::search($tag->name)->get();

        return view('home', [
            'posts' => $posts,
            'tag' => $tag,
            'tags' => $tags
        ]);
    }
}