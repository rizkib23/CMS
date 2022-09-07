<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PengumumanController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:pengumuman_show', ['only' => 'index']);
        $this->middleware('permission:pengumuman_create', ['only' => 'create', 'store']);
        $this->middleware('permission:pengumuman_update', ['only' => 'edit', 'update']);
        $this->middleware('permission:pengumuman_delet', ['only' => 'destroy']);
        $this->middleware('permission:pengumuman_detail', ['only' => 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pengumuman.index', [
            'pengumuman' => Pengumuman::all(),
            'user' => User::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Pengumuman $pengumuman)
    {
        return view('pengumuman.create', [
            'pengumuman' => $pengumuman,
            'user' => User::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Pengumuman $pengumuman)
    {
        $user_id = Auth::user();
        Pengumuman::create([
            'user_id' => $user_id->id,
            'isi' => $request->isi,
            'tanggal' => now()
        ]);
        return redirect('/pengumuman');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('pengumuman.detail', [
            'pengumuman' => Pengumuman::find($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pengumuman.edit', [
            'pengumuman' => Pengumuman::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pengumuman $pengumuman)
    {
        $pengumuman->update([
            'isi' => $request->isi
        ]);
        return redirect('/pengumuman');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}