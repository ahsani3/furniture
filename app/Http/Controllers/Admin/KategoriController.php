<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::get();

        return view('admin.kategori.index', compact('kategori'), ['title' => 'Kategori']);
    }

    public function create()
    {
        return view('admin.kategori.create', ['title' => 'Kategori']);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_kategori' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        $kategori = Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi,
        ]);

        if ($kategori) {
            return redirect()->route('kategori.index')->with(['success' => 'Data berhasil ditambah']);
        } else {
            return redirect()->back()->withInput()->with(['error' => 'Data gagal ditambah']);
        }
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'), ['title' => 'Kategori']);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_kategori' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        $kategori = Kategori::findOrFail($id);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi,
        ]);

        if ($kategori) {
            return redirect()->route('kategori.index')->with(['success' => 'Data berhasil diedit']);
        } else {
            return redirect()->back()->withInput()->with(['error' => 'Data gagal diedit']);
        }
    }

    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        if ($kategori) {
            return redirect()->route('kategori.index')->with(['success' => 'Data berhasil dihapus']);
        } else {
            return redirect()->back()->withInput()->with(['error' => 'Data gagal dihapus']);
        }
    }
}
