<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{

    public function index()
    {
        $kategoris = Kategori::all();
        return view('admin.kategori.index', ['kategoris' => $kategoris]);
    }

    public function store(Request $request)
    {
        Kategori::create([
            'kategori' => $request->input('kategori')
        ]);
        return redirect()->to(route('kategori.index'))->with('success', 'Kategori berhasil ditambahkan');
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'kategori' => 'required'
        ]);
        Kategori::where('id', $kategori->id)->update([
            'kategori' => $request->input('kategori')
        ]);
        return redirect()->to(route('kategori.index'))->with('success', 'Kategori berhasil diubah');
    }

    public function destroy(Kategori $kategori)
    {
        Kategori::destroy($kategori->id);
        return redirect()->to(route('kategori.index'))->with('success', 'Kategori berhasil dihapus');
    }
}
