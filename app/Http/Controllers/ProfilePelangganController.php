<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        $rules = [
            'name' => 'required',
            'no_telepon' => 'required',
            'alamat' => 'required',
            'username' => 'required',
        ];

        $messages = [
            'name.required' => 'Nama tidak boleh kosong',
            'no_telepon.required' => 'No Telepon tidak boleh kosong',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'username.required' => 'Username tidak boleh kosong',
        ];
        // Jika ada request password, maka tambahkan 

        $data = $request->validate($rules, $messages);
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $profile->update($data);
        return redirect()->back()->with('success', 'Profile berhasil diupdate');
    }
}
