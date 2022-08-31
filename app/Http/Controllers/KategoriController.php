<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategoris = kategori::all();
        return view('kategori.admin', compact('kategoris'));
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
            time() . ".". $request->file('thumbnail')->getClientOriginalExtension(), 'public');
        $kategori = Kategori::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name, '-'),
            'thumbnail' => $fileName,
        ]);
        Alert::success('Success', 'Kategori Berhasil Ditambahkan!');
        return redirect()->route('kategori.admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kategoris = kategori::find($id);
        return view('dashboard.kategori.edit', compact('kategoris'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategoris = kategori::find($id);
        return view('kategori.edit', compact('kategoris'));
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
        $fileName = $kategori->thumbnail;
        if ($request->hasFile('thumbnail')) {
            $fileName = $request->file('thumbnail')->storeAs('thumbnails',time() . ".". $request->file('thumbnail')->getClientOriginalExtension(), 'public');
            Storage::delete(['public/'. $kategori->thumbnail]);
        }
        $kategori->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'thumbnail' => $fileName,
        ]);
        Alert::success('Success', 'Kategori Berhasil Diupdate!');
        return redirect('kategori.admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori->delete();
        Alert::success('Success', 'Kategori Berhasil Dihapus!');
        return redirect('/kategori');
    }
}
