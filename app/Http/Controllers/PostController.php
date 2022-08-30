<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Kategori;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = post::all();
        return view('dashboard.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('dashboard.post.create', [
            'kategoris' => Kategori::all()
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
        $fileName = $request->file('thumbnail')->storeAs('thumbnails',time() . ".". $request->file('thumbnail')->getClientOriginalExtension(), 'public');
        $post = post::create([
            'judul' => $request->judul,
            'slug' => $request->slug,
            'thumbnail' => $fileName,
            'deskripsi' => $request->deskripsi,
            'content' => $request->content,
            'kategori_id' => $request->kategori_id,
            'status' => $request->status,
        ]);
        Alert::success('Success', 'Post Berhasil Ditambahkan!');
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $kategoris = Kategori::all();
        return view('dashboard.post.detail', compact('post','kategoris'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $id)
    {
        $kategoris = post::find($id);
        return view('dashboard.post.edit');
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
        //
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
        Alert::success('Success', 'Post Berhasil Dihapus!');
        return redirect('/dashboard/post');
    }
}
