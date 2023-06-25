<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::join('kategoris', 'produks.kategori_id', '=', 'kategoris.id')->get(['produks.*', 'kategoris.nama_kategori']);

        return view('admin.produk.index', compact('produk'), ['title' => 'Produk']);
    }

    public function create()
    {
        $kategori = Kategori::get();

        return view('admin.produk.create', compact('kategori'), ['title' => 'Produk']);
    }

    public function store(Request $request)
    {
        // ddd($request);
        $this->validate($request, [
            'kategori_id' => 'required|',
            "nama_produk" => 'required|',
            "deskripsi" => 'required|',
            "harga" => 'required|',
            "stok" => 'required|',
            "gambar_produk" => 'required|mimes:png,jpg|max:2048',
        ]);
        $fileName = time() . '_' . $request->file('gambar_produk')->getClientOriginalName();

        $produk = Produk::create([
            'kategori_id' => $request->kategori_id,
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar_produk' => $fileName,
        ]);

        if ($produk) {
            $request->file('gambar_produk')->storeAs('uploads', $fileName, 'public');
            return redirect()->route('produk.index')->with(['success' => 'Data berhasil ditambah']);
        } else {
            return redirect()->back()->withInput()->with(['error' => 'Data gagal ditambah']);
        }
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $kategori = Kategori::get();
        return view('admin.produk.edit', compact('produk', 'kategori'), ['title' => 'Produk']);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'kategori_id' => 'required|',
            "nama_produk" => 'required|',
            "deskripsi" => 'required|',
            "harga" => 'required|',
            "stok" => 'required|',
            "gambar_produk" => 'mimes:png,jpg|max:2048',
        ]);


        $produk = Produk::findOrFail($id);
        $produk->update([
            'kategori_id' => $request->kategori_id,
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);
        if ($request->file('gambar_produk') == null) {
            $produk->update(['gambar_produk' => $request->old_img]);
        } else {
            $fileName = time() . '_' . $request->file('gambar_produk')->getClientOriginalName();
            $produk->update(['gambar_produk' => $fileName]);
            unlink(public_path('/storage/uploads/' . $request->old_img));
            $request->file('gambar_produk')->storeAs('uploads', $fileName, 'public');
        }
        if ($produk) {
            return redirect()->route('produk.index')->with(['success' => 'Data berhasil diedit']);
        } else {
            return redirect()->back()->withInput()->with(['error' => 'Data gagal diedit']);
        }
    }

    public function destroy(Request $request, $id)
    {
        $produk = Produk::find($id);
        $produk->delete();
        if ($produk) {
            unlink(public_path('/storage/uploads/' . $request->old_img));
            return redirect()->route('produk.index')->with(['success' => 'Data berhasil dihapus']);
        } else {
            return redirect()->back()->withInput()->with(['error' => 'Data gagal dihapus']);
        }
    }
}
