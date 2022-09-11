<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:role_show', ['only' => 'index']);
        $this->middleware('permission:role_create', ['only' => 'create', 'store']);
        $this->middleware('permission:role_update', ['only' => 'edit', 'update']);
        $this->middleware('permission:role_delet', ['only' => 'destroy']);
        $this->middleware('permission:role_detail', ['only' => 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('role.index', [
            'roles' => Role::all()->where('name', '<>', 'Super Admin')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('role.tambah', [
            'roles' => Role::all(),
            'authorities' => config('permission.authorities'),
            // 'rolePermissions' => $role->permissions->pluck('name')->toArray()
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

        $validator = validator::make($request->all(), [
            'name' => "required|string|max:50|unique:roles,name",

        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }


        $role = Role::create(['name' => $request->name]);
        $role->givePermissionTo($request->permissions);
        Alert::success('Success', 'Role Berhasil DiTambahkan!');
        return redirect('/roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('role.detail', [
            'roles' => $role,
            'authorities' => config('permission.authorities'),
            'rolePermissions' => $role->permissions->pluck('name')->toArray()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('role.edit', [
            'role' => $role,
            'authorities' => config('permission.authorities'),
            'permissionsChecked' => $role->permissions->pluck('name')->toArray()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {

        $role->name = $request->name;
        $role->syncPermissions($request->permissions);
        $role->save();
        Alert::success('Success', 'Role Berhasil DiUpdate');
        return redirect('/roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {

        $role->revokePermissionTo($role->permissions->pluck('name')->toArray());
        $role->delete();
        Alert::success('Success', 'Role Berhasil DiHapus');
        return redirect('/roles');
    }
}