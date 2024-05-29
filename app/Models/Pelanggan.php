<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'alamat',
        'no_telepon',
        'foto'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pesanans()
    {
        return $this->hasMany(Pesanan::class);
    }
}
