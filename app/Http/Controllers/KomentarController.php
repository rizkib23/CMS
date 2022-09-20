<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomentarController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:komentar_show', ['only' => 'index']);
        $this->middleware('permission:komentar_create', ['only' => 'create', 'store']);
        $this->middleware('permission:komentar_update', ['only' => 'edit', 'update']);
        $this->middleware('permission:komentar_delet', ['only' => 'destroy']);
        $this->middleware('permission:komentar_detail', ['only' => 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());s
        $coment = Komentar::create([
            'user_id' => Auth::user()->id,
            'post_id' => $request->post_id,
            'isi' => $request->isi,
            'parent' => $request->parent
        ]);
        return redirect()->back()->with('succses');
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
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Komentar $komentar, $id)
    {
        $komentar = Komentar::find($id);
        $komentar->update([
            'user_id' => Auth::user()->id,
            'isi' => $request->isi,
            'parent' => $request->parent,
            'post_id' => $request->post_id
        ]);
        return redirect()->back()->with('succses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dataKomen = Komentar::find($id);
        $dataKomen->delete();
        return redirect()->back();
    }
}