<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Tag;

class PostController extends Controller
{
    private $path = 'thumbnails';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategoris = Kategori::all();
        $posts = post::all();
        $user = User::all();
        return view('post.admin', compact('posts', 'kategoris', 'user'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userCreate()
    {
        $kategoris = Kategori::all();
        $posts = post::all();
        return view('post.createUser', compact('posts', 'kategoris'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $post)
    {
        return view('post.create', [
            'kategoris' => Kategori::all(),
            'tags' => Tag::all(),
            'post' => $post
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth::user();

        $fileName = $request->file('thumbnail')
            ->storeAs(
                $this->path,
                time() . "." . $request->file('thumbnail')->getClientOriginalExtension(),
                'public'
            );
        $post = post::create([
            'user_id' => $user_id->id,
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul, '-'),
            'thumbnail' => $fileName,
            'deskripsi' => $request->deskripsi,
            'content' => $request->content,
            'kategori_id' => $request->kategori_id,
            'tag_id' => $request->tag_id,
            'status' => $request->status,
        ]);

        return redirect('/post');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post, Kategori $kategoris, Tag $tags)
    {
        $kategoris = Kategori::find($post);
        $tags = Tag::find($post);
        return view('dashboard.post.detail', compact('post', 'kategoris', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post, Kategori $kategoris, Tag $tags)
    {
        $kategoris = Kategori::find($post);
        $tags = Tag::find($post);
        return view('dashboard.post.edit', compact('post', 'kategoris', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $fileName = $post->thumbnail;
        if ($request->hasFile('thumbnail')) {
            $fileName = $request->file('thumbnail')->storeAs('thumbnails', time() . "." . $request->file('thumbnail')->getClientOriginalExtension(), 'public');
            Storage::delete(['public/' . $post->thumbnail]);
        }
        $post->update([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul, '-'),
            'thumbnail' => $fileName,
            'deskripsi' => $request->deskripsi,
            'content' => $request->content,
            'kategori_id' => $request->kategori_id,
            'tag_id' => $request->tag_id,
            'status' => $request->status,
        ]);

        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect('/post');
    }
}