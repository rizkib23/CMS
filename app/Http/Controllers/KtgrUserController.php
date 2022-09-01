<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KtgrUserController extends Controller
{
    public function index()
    {
        return view('kategori/user',[
            'kategori'=>Kategori::all(),
            'title'=> 'Kategori'
        ]);
    }
}
