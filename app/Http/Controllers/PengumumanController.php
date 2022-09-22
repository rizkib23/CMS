<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

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
    public function index(Request $request)
    {
        $pengumuman = Pengumuman::orderBy('id', 'desc')->get();
        if ($request->ajax()) {
            $allData = DataTables::of($pengumuman);
            return $allData;
        }

        $conten = [
            'pengumuman' => $pengumuman,
            'title' => 'Pengumumna'
        ];
        return view('pengumuman.index', $conten);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Pengumuman $pengumuman)
    {

        $conten = [
            'pengumuman' => $pengumuman,
            'user' => Auth::user()->id,
            'title' => "Pengumuman"
        ];

        return view('pengumuman.create', $conten);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Pengumuman $pengumuman)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|max:255',
            'judul' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
        $user_id = Auth::user()->id;
        Pengumuman::create([
            'user_id' => $user_id,
            'isi' => $request->isi,
            'tanggal' => now(),
            'judul' => $request->judul
        ]);
        Alert::success('Success', 'Pengumuman Berhasil DiTambahkan!');
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

        $pengumunan = Pengumuman::find($id);

        return response()->json([
            $pengumunan
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
        $conten = [
            'pengumuman' => Pengumuman::find($id),
            'title' => 'Pengumuman'
        ];
        return view('pengumuman.edit', $conten);
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
        $validator = Validator::make($request->all(), [
            'judul' => 'required|max:255',
            'judul' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }
        $pengumuman->update([
            'isi' => $request->isi,
            'judul' => $request->judul
        ]);
        Alert::success('Success', 'Pengumuman Berhasil DiUdate');
        return redirect('/pengumuman');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete($pengumuman->id);
        return response()->json([
            'success' => true
        ]);
    }
}