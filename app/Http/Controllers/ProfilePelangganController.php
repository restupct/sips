<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilePelangganController extends Controller
{
    public function index()
    {
        $profile = User::with('pelanggan')->find(auth()->user()->id);
        return view('front.profile.profile', [
            'profile' => $profile,
        ]);
    }

    public function update(Request $request)
    {
        $profile = User::with('pelanggan')->find(auth()->user()->id);
        // name, email, username, password -> user
        // alamat, no_telepon, foto -> pelanggan
        $rules = [
            'name' => 'required',
            'username' => 'required',
            'no_telepon' => 'required',
            'alamat' => 'required',
        ];

        $messages = [
            'name.required' => 'Nama tidak boleh kosong',
            'username.required' => 'Username tidak boleh kosong',
            'no_telepon.required' => 'No Telepon tidak boleh kosong',
            'alamat.required' => 'Alamat tidak boleh kosong',
        ];
        // Jika ada request password, maka tambahkan

        $data = $request->validate($rules, $messages);
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        if ($request->hasFile('foto')) {
            if($profile->pelanggan->foto ){
                Storage::disk('public')->delete($profile->pelanggan->foto);
            }
            $data['foto'] = $request->file('foto')->store('pelanggan', 'public');
        }
        $profile->update($data);
        $profile->pelanggan->update($data);
        return redirect()->back()->with('success', 'Profile berhasil diupdate');
    }
}
