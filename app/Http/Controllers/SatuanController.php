<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;

class SatuanController extends Controller
{
    public function index()
    {
        $satuans = Satuan::all();
        return view('admin.satuan.index', ['satuans' => $satuans]);
    }

    public function store(Request $request)
    {
        $rule = ['satuan' => 'required'];
        $messages = ['satuan.required' => 'Satuan harus diisi'];
        $barang = $this->validate($request, $rule, $messages);


        Satuan::create($barang);
        return redirect()->to(route('satuan.index'))->with('success', 'Satuan berhasil ditambahkan');
    }

    public function update(Request $request, Satuan $satuan)
    {
        $request->validate([
            'satuan' => 'required'
        ]);
        Satuan::where('id', $satuan->id)->update([
            'satuan' => $request->input('satuan')
        ]);
        return redirect()->to(route('satuan.index'))->with('success', 'Satuan berhasil diubah');
    }

    public function destroy(Satuan $satuan)
    {
        Satuan::destroy($satuan->id);
        return redirect()->to(route('satuan.index'))->with('success', 'Satuan berhasil dihapus');
    }
}
