<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KtgrUserController extends Controller
{
    public function index()
    {
        return view('kategoris/user',[
            'kategoris'=>Kategori::all(),
            'title'=> 'Kategori'
        ]);
    }
}
