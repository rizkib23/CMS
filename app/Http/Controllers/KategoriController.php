<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;
use LDAP\Result;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
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
        $kategoris = kategori::all();
        return view('kategori.admin', [
            'title' => 'Kategori',
            'kategoris' => $kategoris
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori.create', [
            'title' => 'Kategori',
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255|unique:kategoris'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
        try {
            $kategori = Kategori::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name, '-'),
                'thumbnail' => parse_url($request->thumbnail)['path'],
            ]);
            Alert::success('Success', 'Tag Berhasil Ditambahkan!');
            return redirect()->route('kategoris.index');
        } catch (\Throwable $th) {
            Alert::error('Error', 'Tag Gagal Ditambahkan!');
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(kategori $kategori)
    {
        return view('kategori.detail', [
            'title' => 'Kategori',
            'kategoris' => $kategori
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function edit(kategori $kategoris, $id)
    {
        $kategoris = kategori::find($id);
        return view('kategori.edit', [
            'title' => 'Kategori',
            'kategoris' => $kategoris
        ]);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
        $kategori->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'thumbnail' =>  parse_url($request->thumbnail)['path'],
        ]);
        Alert::success('Success', 'Kategori Berhasil DiUpdate!');
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


        try {
            if ($kategori->thumbnail) {
                File::delete('thumbnail', $kategori->thumbnail);
            }
            $coba = Kategori::destroy($kategori->id);
        } catch (\Throwable $th) {
            Alert::error('Error', 'Kategori Gagal Dihapus!', ['error' => $th->getMessage()]);
            return redirect('/kategoris');
        }
        Alert::success('Success', 'Kategori Berhasil Dihapus!');
        return redirect('/kategoris');
    }
}