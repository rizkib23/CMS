<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;


class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kategoris/admin',[
            'kategoris'=>Kategori::orderBy('id','desc')->get(),
            'title'=> 'Kategori'
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategoris.create');
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
        $kategori = Kategori::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'thumbnail' => $fileName,
        ]);
        Alert::success('Success', 'Kategori Berhasil Ditambahkan!');
        return redirect()->route('kategori.index');
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
        $kategoris = Kategori::find($id);
        return view('kategoris.edit', compact('kategoris'));
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
            
            Storage::delete(['public/'. $kategori->thumbnail]);
            $fileName = $request->file('thumbnail')->storeAs('thumbnails',time() . ".". $request->file('thumbnail')->getClientOriginalExtension(), 'public');
        }
        $kategori->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'thumbnail' => $fileName,
        ]);
        Alert::success('Success', 'Kategori Berhasil Diupdate!');
        return redirect('/dashboard/kategori');
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
        return redirect('/kategoris');
    }
}
