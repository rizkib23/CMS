<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use App\Http\Requests\StoreProfilRequest;
use App\Http\Requests\UpdateProfilRequest;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use RealRashid\SweetAlert\Facades\Alert;

class ProfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:profil_show', ['only' => 'index']);
        $this->middleware('permission:profil_create', ['only' => 'create', 'store']);
        $this->middleware('permission:profil_update', ['only' => 'edit', 'update']);
        $this->middleware('permission:profil_delet', ['only' => 'destroy']);
        $this->middleware('permission:profil_detail', ['only' => 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        return view(
            "profil.profil"
        );
    }
    /**
     * Show the form for creatng a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view(
        //     'profil.create',
        //     [
        //         'user' => User::first(),
        //         'profil' => Profil::first(),
        //         'userAuth' => Auth::user(),
        //     ]
        // );
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
    public function edit(Profil $profil)
    {


        // $user =  Profil::where('user_id', $user->id)->get();
        return view(
            'profil.profil',
            [

                'profile' => $profil,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profil $profil, User $user)
    {
        //  profil 

        $user = User::where('id', Auth::user()->id);
        $fileName = $profil->foto;
        if ($request->hasFile('foto')) {
            $fileName = $request->file('foto')->storeAs('foto', time() . "." . $request->file('foto')->getClientOriginalExtension(), 'public');
            Storage::delete(['public/' . $profil->foto]);
        }
        $updateProfil = $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        $update = $profil->where('user_id', Auth::user()->id)->update([
            'foto' => $fileName,
            'jenis_kelamin' => $request->jenis_kelamin,
            'no_tlp' => $request->no_tlp
        ]);
        Alert::success('Success', 'Profil Berhasil DiUpdate!');
        return redirect('/profil');
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