<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Routing\RedirectController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:tag_show', ['only' => 'index']);
        $this->middleware('permission:tag_create', ['only' => 'create', 'store']);
        $this->middleware('permission:tag_update', ['only' => 'edit', 'update']);
        $this->middleware('permission:tag_delet', ['only' => 'destroy']);
        $this->middleware('permission:tag_detail', ['only' => 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tag =  Tag::orderBy('id', 'desc')->get();
        $content = [
            'title' => 'Tag',
            'tags' => $tag

        ];
        return view('tags/admin', $content);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.insert', [
            'title' => 'Tag',
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
        $tags = Tag::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
        ]);
        Alert::success('Success', 'Tag Berhasil DiTambahkan!');
        return redirect()->route('tags.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tags = Tag::find($id);
        return view('tags.edit', [
            'title' => 'Tag',
            'tags' => $tags
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'unique:tags'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => false, 'message' => $validator->errors()->first()]);
        }

        try {
            Tag::find($id)->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-'),
            ]);
        } catch (\Throwable $th) {
            Alert::error('Error', 'Tag Gagal DiUpdate!');
            return redirect()->back();
        }

        Alert::success('Success', 'Tag Berhasil DiUpdate!');
        return redirect('/tags');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {


        try {
            Tag::find($tag->id)->delete();
        } catch (\Throwable $th) {
            Alert::error('Error', 'Kategori Gagal Dihapus!', ['error' => $th->getMessage()]);
            return redirect('/tags');
        }
        return redirect()->route('tags.index')
            ->with('success', 'User deleted successfully');
    }
}