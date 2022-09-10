<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Tag;
use App\Models\TagPost;
use App\Models\TagPostingan;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;


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
    public function index(Request $request)
    {
        $statusSelected = in_array($request->get('status'), ['publish', 'draft']) ? $request->get('status') : "publish";
        $posts = $statusSelected == "publish" ? Post::publish() : Post::draft();
        // $posts = Post::latest()->paginate(5);
        if ($request->get('keyword')) {
            $posts->search($request->get('keyword'));
        }
        return view('post.admin', [
            'posts' => $posts->get(),
            'statuses' => $this->statuses(),
            'statusSelected' => $statusSelected,
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
                'kategori_id' => $request->kategori_id,
                'status' => $request->status,
                'user_id' => Auth::user()->id
            ];
            $createPost = Post::create($dataPost);

            $dataTagPost = [];
            foreach ($request->tag as $key => $dtTag) {
                $createTagPost = TagPost::create([
                    'post_id' => $createPost->id,
                    'tag_id' => $dtTag,
                ]);
            }

            Alert::success('Success', 'Post Berhasil DiInput!');
            return redirect()->route('post.index');

            Alert::success('Success', 'Post Berhasil DiInput!');
            return redirect()->route('post.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Alert::error('Error', 'data gagal disimpan', ['error' => $th->getMessage()]);
            if ($request['tag']) {
                $request['tag'] = Tag::select('id', 'name')->whereIn('id', $request->tag)->get();
            }
            return redirect()->route('post.create');
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
        return view('post.detail', compact('post'));
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
        return view('post.edit', compact('post', 'kategoris', 'tags', 'statuses'));
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
                'kategori_id' => $request->kategori_id,
                'status' => $request->status
            ];
            Post::where('id', $request->id)->update($dataPost);


            $dataTagPost = [];
            $tagPost->where('post_id', $request->id)->delete();
            foreach ($request->tag as $dtTag) {
                $createTagPost = TagPost::create([
                    'post_id' => $request->id,
                    'tag_id' => $dtTag,
                ]);
            }

            Alert::success('Success', 'Post Berhasil DiUpdate!');
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        Alert::success('Success', 'Post Berhasil Dihapus!');
        return redirect('/post');
    }

    private function statuses()
    {
        return [
            'draft' => 'draft',
            'publish' => 'publish'
        ];
    }
}