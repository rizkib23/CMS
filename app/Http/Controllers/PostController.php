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
use App\Models\TagPostingan;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:post_show', ['only' => 'index']);
        $this->middleware('permission:post_create', ['only' => 'create', 'store']);
        $this->middleware('permission:post_update', ['only' => 'edit', 'update']);
        $this->middleware('permission:post_delet', ['only' => 'destroy']);
        $this->middleware('permission:post_detail', ['only' => 'show']);
    }

    private $path = 'thumbnails';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('post.admin', [
            'kategoris' => Kategori::all(),
            'tags' => Tag::all(),
            'posts' => Post::all()
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Post $post)
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

        TagPostingan::crate([
            'tag_id' => $post->kategori_id,
            'postingan_id' => $post->id
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