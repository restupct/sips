<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pelanggan_id',
        'no_transaksi',
        'sub_total',
        'diskon',
        'total',
        'tanggal',
        'status',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
    public function barangs()
    {
        return $this->belongsToMany(Barang::class, 'pesanan_barangs', 'pesanan_id', 'barang_id')->withPivot('qty', 'sub_total');
    }
}
