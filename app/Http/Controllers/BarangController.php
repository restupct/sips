<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();
        return view('admin.barang.index', ['barangs' => $barangs]);
    }

    public function create()
    {
        $satuans = Satuan::all();
        $kategoris = Kategori::all();
        return view('admin.barang.create', [
            'satuans' => $satuans,
            'kategoris' => $kategoris
        ]);
    }

    private $rules = [
        'nama_barang' => 'required',
        'stok' => 'required',
        'harga' => 'required',
        'foto' => 'required|image|max:2048',
        'satuan_id' => 'required',
        'kategori_id' => 'required',
    ];

    private $messages = [
        'nama_barang.required' => 'Nama barang tidak boleh kosong',
        'stok.required' => 'Stok tidak boleh kosong',
        'harga.required' => 'Harga tidak boleh kosong',
        'foto.required' => 'Foto tidak boleh kosong',
        'foto.image' => 'File harus bertipe gambar',
        'foto.max' => 'Ukuran foto tidak boleh lebih dari 2MB',
        'satuan_id.required' => 'Satuan tidak boleh kosong',
        'kategori_id.required' => 'Kategori tidak boleh kosong',
    ];
    public function store(Request $request)
    {
        $barang = $this->validate($request, $this->rules, $this->messages);

        $originalName = str_replace(' ', '-', time() . $barang['foto']->getClientOriginalName());
        if ($request->file('foto')) {
            $barang['foto'] = $request->file('foto')->storeAs('public/barang', $originalName);
        }
        $barang['foto'] = 'barang/' . $originalName;

        Barang::create($barang);
        return redirect()->to(route('barang.index'))->with('success', 'Barang berhasil ditambahkan');
    }

    public function getBarang($id)
    {
        $barang = Barang::find($id);
        return response()->json($barang);
    }
    public function show(Barang $barang)
    {
    }

    public function edit(Barang $barang)
    {
        $satuans = Satuan::all();
        $kategoris = Kategori::all();
        return view('admin.barang.edit', [
            'satuans' => $satuans,
            'kategoris' => $kategoris,
            'barang' => $barang
        ]);
    }

    public function update(Request $request, Barang $barang)
    {
        if ($request->hasFile('foto')) {
            // validasi inputan
            $barangUpdate = $this->validate($request, $this->rules, $this->messages);
            // Ambil nama file asli dan sedikit modif
            $originalName = str_replace(' ', '-', time() . $request->foto->getClientOriginalName());
            $request->file('foto')->storeAs('public/barang', $originalName);
            $barangUpdate['foto'] = $originalName;
            // hapus file lama
            Storage::delete('public/barang/' . $barang->foto);
        } else {
            $this->rules['foto'] = '';
            $barangUpdate = $this->validate($request, $this->rules, $this->messages);
        }

        Barang::where('id', $barang->id)->update($barangUpdate);
        return redirect()->to(route('barang.index'))->with('success', 'Data barang berhasil diubah');
    }

    public function destroy(Barang $barang)
    {
        if ($barang->foto) {
            Storage::delete('public/barang/' . $barang->foto);
        }
        Barang::destroy($barang->id);
        return redirect()->to(route('barang.index'))->with('success', 'Barang berhasil dihapus');
    }
}
