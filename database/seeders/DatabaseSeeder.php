<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Pelanggan;
use App\Models\Satuan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $fotopelanggan = public_path('asset/avatar-02.jpg');
        $pelanggan = Storage::disk('public')->put('pelanggan', new \Illuminate\Http\File($fotopelanggan), 'public');
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'role' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
        ]);
        User::create([
            'name' => 'Agus',
            'username' => 'agus',
            'password' => bcrypt('agus'),
        ]);
        User::create([
            'name' => 'Bambang',
            'username' => 'bambang',
            'password' => bcrypt('bambang'),
        ]);
        User::create([
            'name' => 'Paijo',
            'username' => 'paijo',
            'password' => bcrypt('paijo'),
        ]);

        Pelanggan::create([
            'user_id' => 2,
            'alamat' => 'Jl. Raya No.123 Ploso, Punung',
            'foto' => $pelanggan,
            'no_telepon' => '0812xxxxxxxx',
        ]);
        Pelanggan::create([
            'user_id' => 3,
            'alamat' => 'Jl. Raya No.456 Ploso, Punung',
            'no_telepon' => '0876xxxxxxxx',
        ]);
        Pelanggan::create([
            'user_id' => 4,
            'alamat' => 'Jl. Raya No.789 Sekar, Donorojo',
            'no_telepon' => '0890xxxxxxxx',
        ]);

        Kategori::create([
            'kategori' => 'Sembako',
        ]);
        Kategori::create([
            'kategori' => 'Frozen Food',
        ]);
        Kategori::create([
            'kategori' => 'Makanan Kucing',
        ]);
        Kategori::create([
            'kategori' => 'Gas LPG',
        ]);

        Satuan::create([
            'satuan' => 'Kg' // 1
        ]);
        Satuan::create([
            'satuan' => 'Tabung' // 2
        ]);
        Satuan::create([
            'satuan' => 'PCS' // 3
        ]);
        Satuan::create([
            'satuan' => 'Dus'
        ]);

        $this->call([
            BarangSeeder::class,
            BarangMasukSeeder::class,
            PesananSeeder::class,
        ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
