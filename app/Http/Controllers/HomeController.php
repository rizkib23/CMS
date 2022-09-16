<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Kategori;
use App\Models\Pengumuman;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $perpage = 10;

    public function home()
    {
        $pengumuman = Pengumuman::orderBy('id', 'desc')->get();
        $tag = Tag::all();
        $post = Post::publish()->latest()->paginate($this->perpage);
        $content = [
            'title' => "Home",
            'posts' => $post,
            'tag' => $tag,
            'notif' => $pengumuman
        ];
        return view('home', $content);
    }

    public function listKategori()
    {
        $kategoris = Kategori::all();
        $content =  [
            'title' => "Kategori",
            'kategoris' => $kategoris
        ];
        return view('kategori', $content);
    }

    public function searchPosts(Request $request, Post $posts)
    {
        if ($request->get('keyword')) {
            $posts->search($request->get('keyword'));
        }
        $pos = Post::Publish()->search($request->keyword)
            ->paginate($this->perpage)
            ->appends(['keyword' => $request->keyword]);
        $content = [
            'title' => $posts->judul,
            'posts' => $pos
        ];
        return view('search-post', $content);
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
        $posts = Post::with(['dataKategori', 'dataTagPost.dataTags'])->where('slug', $slug)->first();
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
// Schema::create('komentars', function (Blueprint $table) {
//     $table->id();
//     $table->foreignId('user_id')->constrained('users');
//     $table->foreignId('post_id')->constrained('posts');
//     $table->text('isi');
//     $table->string('parent');
//     $table->timestamps();
// });