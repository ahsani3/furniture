<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index($slug = null)
    {
        $produk = Produk::get();
        $kategori = Kategori::get();

        return view('frontend.produk.index', compact('slug', 'produk', 'kategori'));
    }

    public function show($id)
    {
        $produk = Produk::join('kategoris', 'produks.kategori_id', '=', 'kategoris.id')->findOrFail($id);
        return view('frontend.produk.show', compact('produk'));
    }
}
