<?php

namespace App\Http\Controllers;

use App\Models\Meta;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class MetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $metas = Meta::all();
        return view('dashboard.meta.index', compact('metas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.meta.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $metas = Meta::create([
            'title' => $request->title,
            'meta_keyword' => $request->meta_keyword,
            'meta_deskripsi' => $request->meta_deskripsi,
        ]);
        return redirect()->route('meta.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meta  $meta
     * @return \Illuminate\Http\Response
     */
    public function show(Meta $meta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meta  $meta
     * @return \Illuminate\Http\Response
     */
    public function edit(Meta $meta, $id)
    {
        $meta = Meta::find($id);
        return view('dashboard.meta.edit', compact('meta'));
        return redirect()->route('meta.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Meta  $meta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meta $meta)
    {
        $meta->update([
            'title' => $request->title,
            'meta_keyword' => $request->meta_keyword,
            'meta_deskripsi' => $request->meta_deskripsi,
        ]);
        return redirect('/dashboard/meta/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meta  $meta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meta $meta)
    {
        $meta->delete();
        Alert::success('Success', 'Meta Berhasil Dihapus!');
        return redirect()->route('meta.index');
    }
}
