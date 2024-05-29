<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::with('user')->get();
        return view('admin.pelanggan.index', ['pelanggans' => $pelanggans]);
    }

    public function create()
    {
        return view('admin.pelanggan.create');
    }

    private $rules = [
        'name' => 'required',
        'username' => 'required',
        'password' => 'required',
        'no_telepon' => 'required',
        'alamat' => 'required',
        'foto' => 'image|max:2048',
    ];

    private $messages = [
        'name.required' => 'Nama harus diisi',
        'username.required' => 'Username harus diisi',
        'password.required' => 'Password harus diisi',
        'no_telepon.required' => 'Nomor telepon harus diisi',
        'alamat.required' => 'Alamat harus diisi',
        // 'foto.required' => 'Foto harus diisi',
        'foto.image' => 'File harus bertipe gambar',
        'foto.max' => 'Ukuran foto tidak boleh lebih dari 2MB',
    ];

    public function store(Request $request)
    {
        // Validasi inputan admin
        $pelanggan = $this->validate($request, $this->rules, $this->messages);
        if ($request->hasFile('foto')) {
            $namaFile = str_replace(' ', '-', time() . $pelanggan['foto']->getClientOriginalName());
            $request->file('foto')->storeAs('public/pelanggan', $namaFile);
            $pelanggan['foto'] = 'pelanggan/' . $namaFile;
        }
        // add username and password to User and alamat to Pelanggan
        $user = User::create([
            'name' => $pelanggan['name'],
            'username' => $pelanggan['username'],
            'password' => bcrypt($pelanggan['password']),
        ]);
        $pelanggan = Pelanggan::create([
            'user_id' => $user->id,
            'no_telepon' => $pelanggan['no_telepon'],
            'alamat' => $pelanggan['alamat'],
            'foto' => $pelanggan['foto'] ?? null,
        ]);
        return redirect()->to(route('pelanggan.index'))->with('success', 'Pelanggan berhasil ditambahkan');
    }

    public function show(Pelanggan $pelanggan)
    {
        $pesanan_pelanggan = Pesanan::with('pelanggan', 'barangs')->where('pelanggan_id', $pelanggan->id)->get();
        return view('admin.pelanggan.show', [
            'pelanggan' => $pelanggan,
            'pesanan_pelanggans' => $pesanan_pelanggan
        ]);
    }

    public function edit(Pelanggan $pelanggan)
    {
        return view('admin.pelanggan.edit', ['pelanggan' => $pelanggan]);
    }

    public function update(Request $request, Pelanggan $pelanggan)
    {
        $this->rules['password'] = '';
        $this->validate($request, $this->rules, $this->messages);

        if ($request->hasFile('foto')) {
            if ($pelanggan->foto) {
                Storage::delete('public/' . $pelanggan->foto);
            }
            $namaFile = str_replace(' ', '-', time() . $request->foto->getClientOriginalName());
            $request->file('foto')->storeAs('public/pelanggan', $namaFile);
            $pelanggan['foto'] = 'pelanggan/' . $namaFile;
        }
        // update User and Pelanggan
        User::where('id', $pelanggan->user_id)->update([
            'name' => $request->name,
            'username' => $request->username,
        ]);
        if ($request->password) {
            User::where('id', $pelanggan->user_id)->update([
                'password' => bcrypt($request->password)
            ]);
        }
        Pelanggan::where('id', $pelanggan->id)->update([
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
            'foto' => $pelanggan['foto'],
        ]);
        return redirect()->to(route('pelanggan.index'))->with('success', 'Data pelanggan berhasil diubah');
    }

    public function destroy(Pelanggan $pelanggan)
    {
        if ($pelanggan->foto) {
            Storage::delete('public/profile-pelanggan/' . $pelanggan->foto);
        }
        Pelanggan::destroy($pelanggan->id);
        User::destroy($pelanggan->user_id);
        return redirect()->back()->with('success', 'Data pelanggan berhasil dihapus');
    }
}
