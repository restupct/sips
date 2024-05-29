<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barangs';
    protected $fillable = [
        'nama_barang',
        'stok',
        'harga',
        'foto',
        'satuan_id',
        'kategori_id'
    ];

    public function satuan()
    {
        return $this->belongsTo(Satuan::class);
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function pesanans()
    {
        return $this->belongsToMany(Pesanan::class, 'pesanan_barangs', 'barang_id', 'pesanan_id');
    }
    public function barang_masuks()
    {
        return $this->hasMany(BarangMasuk::class);
    }
}
