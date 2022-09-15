<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Kategori;
use App\Models\Komentar;
use App\Models\Pengumuman;
use App\Models\Tag;
use App\Models\TagPost;
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

    public function searchPosts(Request $request, Post $posts)
    {
        if ($request->get('keyword')) {
            $posts->search($request->get('keyword'));
        }
        return view('search-post', [
            'title' => $posts->judul,
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

        // dd($slug);
        $kategoris = Kategori::where('slug', $slug)->first();
        $content = [
            'posts' => $posts,
            'kategoris' => $kategoris,
            'title' => $kategoris->name
        ];
        return view('post-kategori', $content);
    }

    public function showPostDetail($slug)
    {

        $posts = Post::with(['dataKategori', 'dataTags'])->where('slug', $slug)->first();
        if (!$posts) {
            return redirect()->route('home');
        }
        // dd($posts);
        return view('post-detail', [
            'posts' => $posts,
            'title' => $posts->judul,
        ]);
    }

    public function showPostByTag($slug)
    {


        $posts = Post::publish()->whereHas('dataTagPost.dataTags', function ($query) use ($slug) {
            return $query->where('slug', $slug);
        })->paginate($this->perpage);


        $dataTags = Tag::where('slug', $slug)->first();
        // $dataTagPost = TagPost::with($dataTags->name)->get();

        $content = [
            'posts' => $posts,
            'title' => $dataTags->name,
        ];

        // dd($dataTagPost);
        return view('post-tag', $content);
    }
}