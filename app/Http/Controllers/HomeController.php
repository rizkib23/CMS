<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class HomeController extends Controller
{
    public function index()
    {
        return view('home',[
            "title" => "home"
        ]);

    }

    
}