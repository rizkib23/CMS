<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Kategori;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $perpage = 10;

    public function home()
    {
        $posts = Post::all();
        $tag = Tag::all();
        return view('home', [
            'title' => "Home",
            'posts' => Post::publish()->latest()->paginate($this->perpage),
            'tag' => $tag
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
            return redirect()->route('home');
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
        $posts = Post::publish()->whereHas('dataKategori', function($query) use ($slug){
            return $query->where('slug',$slug);
        })->paginate($this->perpage);
        
        // dd($slug);
        $kategoris = Kategori::where('slug',$slug)->first();
        $content =[
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
            'title' => $posts->judul
        ]);
    }

    public function showPostByTag($slug)
    {
        $posts = Post::publish()->whereHas('dataTags', function($query) use ($slug){
            return $query->where('slug',$slug);
        })->paginate($this->perpage);

        $tag = Tag::where('slug',$slug)->first();
        $tags =Tag::search($tag->name)->get();

        $content = [
            'title' => $tag->name,
            'posts' => $posts,
            'tag' => $tag,
            'tags' => $tags,
        ];
        return view('post-tag', $content );
    }
}
