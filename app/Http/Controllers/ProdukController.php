<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index($slug = null)
    {
        $produk = Produk::get();

        return view('frontend.produk.index', compact('slug', 'produk'));
    }

    public function show($id)
    {
        $produk = Produk::join('kategoris', 'produks.kategori_id', '=', 'kategoris.id')->findOrFail($id);
        return view('frontend.produk.show', compact('produk'));
    }
}
