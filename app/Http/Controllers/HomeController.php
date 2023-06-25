<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function index()
    {
        $produk = Produk::latest()->take(5)->get();
        return view('frontend.home', compact('produk'));
    }
}
