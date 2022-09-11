<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
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

        return view('tags/admin', [
            'tags' => Tag::orderBy('id', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tags.insert');
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
            'name' => $request->name
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
        return view('tags.edit', compact('tags'));
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
        Tag::find($id)->update(['name' => $request->name]);

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


        Tag::find($tag->id)->delete();
        return redirect()->route('tags.index')
            ->with('success', 'User deleted successfully');
        // Tag::destroy($tag->id);
        // Alert::success('Success', 'Tag Berhasil DiHapus!');
        // return redirect('/tags');
    }
}