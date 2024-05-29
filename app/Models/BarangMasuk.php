<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'barang_id',
        'tanggal',
        'harga_beli',
        'stok',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
