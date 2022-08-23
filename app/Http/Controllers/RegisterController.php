<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('login.register', [
            'title' => 'Register'
        ]);
    }
    public function store(Request $request)
    {
        $validateData = $request -> validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:255'
        ]);
        
     // $validateData['password'] = bcrypt($validateData['password']);
     $validateData['password'] = Hash::make($validateData['password']); 


      User::create($validateData);  
      //$request->sesion()->flash('success','Registrasi Selesai! Silahkan Login');
      return redirect('/login');
    }
}
