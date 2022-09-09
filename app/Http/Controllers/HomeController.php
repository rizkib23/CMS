<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\User;
use App\Models\Pengumuman;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            "title" => "home",
            'pengumuman' => Pengumuman::orderBy('id', 'desc')->get(),
        ]);
    }
}