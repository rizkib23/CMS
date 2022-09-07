<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use LDAP\Result;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use illuminate\Support\Str;

class KategoriController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:kategori_show', ['only' => 'index']);
        $this->middleware('permission:kategori_create', ['only' => 'create', 'store']);
        $this->middleware('permission:kategori_update', ['only' => 'edit', 'update']);
        $this->middleware('permission:kategori_delet', ['only' => 'destroy']);
        $this->middleware('permission:kategori_detail', ['only' => 'show']);
    }

    private $path = 'thumbnail';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kategori/admin', [
            'kategoris' => Kategori::orderBy('id', 'desc')->get(),
            'title' => 'Kategori'
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fileName = $request->file('thumbnail')
            ->storeAs(
                $this->path,
                time() . "." . $request->file('thumbnail')->getClientOriginalExtension(),
                'public'
            );
        $kategori = Kategori::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'thumbnail' => $fileName,
        ]);
        return redirect()->route('kategoris.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(kategori $kategori)
    {
        $kategoris = kategori::find($kategori);
        return view('kategori.detail', compact('kategoris'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(kategori $kategoris, $id)
    {
        $kategoris = Kategori::find($id);
        return view('kategori.edit', compact('kategoris'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kategori $kategori)
    {

        $fileName = $kategori->thumbnail;
        if ($request->hasFile('thumbnail')) {
            $fileName = $request->file('thumbnail')->storeAs('thumbnails', time() . "." . $request->file('thumbnail')->getClientOriginalExtension(), 'public');
            Storage::delete(['public/' . $kategori->thumbnail]);
        }
        $kategori->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'thumbnail' => $fileName,
        ]);
        return redirect('/kategoris');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kategori  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        if ($kategori->thumbnail) {
            File::delete('thumbnail', $kategori->thumbnail);
        }
        Kategori::destroy($kategori->id);
        return redirect('/kategoris');
    }
}