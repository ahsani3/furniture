<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_penerima',
        'alamat_pengiriman',
        'kota',
        'kode_pos',
        'telepon',
    ];
}
