<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Kategori;
use Illuminate\Http\Request;
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
        $statusSelected = in_array($request->get('status'),['publish','draft']) ? $request->get('status') : "publish";
        $posts = $statusSelected == "publish" ? Post::publish() : Post::draft();
        // $posts = Post::latest()->paginate(5);
        if ($request->get('keyword')) {
            $posts->search($request->get('keyword'));
        }
        return view('dashboard.post.index', [
            'title' => 'Post',
            'posts' => $posts->get(),
            'statuses' => $this->statuses(),
            'statusSelected' =>$statusSelected,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Post $post)
    {
        return view('dashboard.post.create', [
            'title' => 'Post',
            'kategoris' => Kategori::all(),
            'tags' => Tag::all(),
            'statuses' => $this->statuses(),
            'post' => $post
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tag $tag, Kategori $kategoris, Post $post)
    { 
        $validator = Validator::make(
            $request->all(),
            [
                'judul' => 'required',
                'thumbnail' => 'required',
                'deskripsi' => 'required',
                'content' => 'required',
                'kategori_id' => 'required',
                'tag' => 'required',
                'status' => 'required',
            ],
            [],
        );
            if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        } 

        try {
            DB::beginTransaction();
            $dataPost = [
                'judul' => $request->judul,
                'slug' => Str::slug($request->judul, '-'),
                'thumbnail' => parse_url($request->thumbnail)['path'],
                'deskripsi' => $request->deskripsi,
                'content' => $request->content,
                'kategori_id' =>$request->kategori_id,
                'status' => $request->status
            ];
            $createPost = Post::create($dataPost);

            $dataTagPost = [];
            foreach ($request->tag as $key => $dtTag){ 
            $createTagPost = TagPost::create([
                'post_id' => $createPost->id,
                'tag_id' => $dtTag,
                ]);
            }
            
            Alert::success('Success', 'Post Berhasil DiInput!');
            return redirect()->route('post.index');

        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Error', 'data gagal disimpan', ['error' => $th->getMessage()]);
            if ($request['tag']) {
                $request['tag'] = Tag::select('id', 'name')->whereIn('id', $request->tag)->get();
            }
            return redirect()->route('post.index');

        } finally {
            DB::commit();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('dashboard.post.detail', [
            'title' => 'Post',
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $kategoris = Kategori::all();
        $tags = Tag::all();
        $statuses = $this->statuses();
        return view('dashboard.post.edit', compact('post', 'kategoris', 'tags', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post, TagPost $tagPost)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'judul' => 'required',
                'thumbnail' => 'required',
                'deskripsi' => 'required',
                'content' => 'required',
                'kategori_id' => 'required',
                'tag' => 'required',
                'status' => 'required',
            ],
            [],
        );
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }   
        try {
            DB::beginTransaction();
            $dataPost = [
                'id' => $request->id,
                'judul' => $request->judul,
                'slug' => Str::slug($request->judul, '-'),
                'thumbnail' => parse_url($request->thumbnail)['path'],
                'deskripsi' => $request->deskripsi,
                'content' => $request->content,
                'kategori_id' =>$request->kategori_id,
                'status' => $request->status
            ];
            Post::where('id', $request->id)->update($dataPost);

            
            $dataTagPost = [];
            $tagPost->where('post_id',$request->id)->delete();
            foreach ($request->tag as $dtTag){ 
                $createTagPost = TagPost::create([
                    'post_id' => $request->id,
                    'tag_id' => $dtTag,
                    ]);
                }

            Alert::success('Success', 'Post Berhasil DiInput!');
            return redirect()->route('post.index');

        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Error', 'data gagal disimpan', ['error' => $th->getMessage()]);
            if ($request['tag']) {
                $request['tag'] = Tag::select('id', 'name')->whereIn('id', $request->tag)->get();
            }
            return redirect()->route('post.index');
         } finally {
        DB::commit();
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

    private function statuses()
    {
        return [
            'draft' => 'draft',
            'publish' => 'publish'
        ];
    }
}
