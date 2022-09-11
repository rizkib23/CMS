<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profil;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\User as Authenticatable;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Traits\HasRoles;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user_show', ['only' => 'index']);
        $this->middleware('permission:user_create', ['only' => 'create', 'store']);
        $this->middleware('permission:user_update', ['only' => 'edit', 'update']);
        $this->middleware('permission:user_delet', ['only' => 'destroy']);
        $this->middleware('permission:user_detail', ['only' => 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $a = Auth::user();
        if ($a->hasRole('Super Admin')) {
            return view("user.index", [
                'user' => User::all()->where('id', '<>', Auth::user()->id),

            ]);
        }
        return view("user.index", [
            'user' => User::role('user')->get()->where('id', '<>', Auth::user()->id),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create', [
            'roles' => Role::all(),
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

        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->email),
        ]);
        //  profil input
        $user->assignRole('user');

        $profil =  Profil::create([
            'user_id' =>  $user->id,
        ]);
        Alert::success('Success', 'Akun Berhasil DiTambahkan!');
        return redirect('/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user.detail', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit', [
            'rolesSelect' => $user->roles->first(),
            'user' => $user,
            'roles' => Role::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        if ($request->status == ('nonaktif')) {
            $user->update([
                'status' => $request->status
            ]);
            $user->removeRole($user->roles->first());
        } else {
            $user->update([
                'status' => $request->status
            ]);
            $user->syncRoles($request->role);
        }
        Alert::success('Success', 'Akun Berhasil DiEdit!');
        return redirect('/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

        try {
            if ($user->getRoleNames() == false) {
                User::destroy($user->id);
            }
            User::destroy($user->id);
            $user->removeRole($user->roles->first());
        } catch (\Throwable $th) {
            Alert::success('Success', 'Akun Berhasil DiHapus!');
            return redirect('/user');
        }
        Alert::success('Success', 'Akun Berhasil DiHapus!');
        return redirect('/user');
    }
}