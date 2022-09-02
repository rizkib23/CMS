<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use App\Http\Requests\StoreProfilRequest;
use App\Http\Requests\UpdateProfilRequest;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ProfilController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profil = Profil::all();
        $user = User::all();
        $useProfil = Auth::user();
        return view("profil", compact('profil', 'user', 'useProfil'));

        // $profil = Profil::all();
        // return view('profil', compact('user', 'profil'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProfilRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfilRequest $request)
    {
        $profils = Profil::create([
            'no_tlp' => $request->no_tlp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'foto' => $request->foto,
        ]);

        return redirect()->route('profil');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profil  $profil
     * @return \Illuminate\Http\Response
     */
    public function show(Profil $profil)
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
        $profil = Profil::all();
        $user = User::all();
        $useProfil = Auth::user();
        return view('create', compact('profil', 'user', 'useProfil'));
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
        //  profil input
        $fileName = $request->file('foto')->storeAs('foto', time() . "." . $request->file('foto')->getClientOriginalExtension(), 'public');
        $profil =  Profil::updated([
            'no_tlp' => $request->no_tlp,
            'jenis_kelamin' => $request->jenis_kelamin,
            'foto' => $fileName,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profil  $profil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profil $profil)
    {
        //
    }
}