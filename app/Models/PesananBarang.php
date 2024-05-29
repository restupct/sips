<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananBarang extends Model
{
    use HasFactory;

    protected $table = 'pesanan_barangs';
    protected $fillable = ['pesanan_id', 'barang_id', 'qty', 'sub_total'];
}
