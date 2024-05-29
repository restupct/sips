<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path_ayam = public_path('asset/ayam.jpg');
        $path_beras = public_path('asset/beras.jpg');
        $path_gas = public_path('asset/gas.jpeg');
        $path_telur = public_path('asset/telur.jpg');

        $ayam = Storage::disk('public')->put('barang', new File($path_ayam), 'public');
        $beras = Storage::disk('public')->put('barang', new File($path_beras), 'public');
        $gas = Storage::disk('public')->put('barang', new File($path_gas), 'public');
        $telur = Storage::disk('public')->put('barang', new File($path_telur), 'public');


        Barang::create([
            'nama_barang' => 'Ayam Potong',
            'kategori_id' => 1,
            'satuan_id' => 1,
            'harga' => 34000,
            'foto' => $ayam,
            'stok' => 10
        ]);

        Barang::create([
            'nama_barang' => 'Beras',
            'kategori_id' => 1,
            'satuan_id' => 1,
            'harga' => 12000,
            'foto' => $beras,
            'stok' => 10
        ]);

        Barang::create([
            'nama_barang' => 'Gas LPG 3 Kg',
            'kategori_id' => 4,
            'satuan_id' => 2,
            'harga' => 19000,
            'foto' => $gas,
            'stok' => 20
        ]);

        Barang::create([
            'nama_barang' => 'Telur Ayam',
            'kategori_id' => 1,
            'satuan_id' => 1,
            'harga' => 31000,
            'foto' => $telur,
            'stok' => 10
        ]);
    }
}
