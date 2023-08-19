<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class paket extends Model
{
    use HasFactory;
    protected $table = 'pakets';
    protected $fillable = [
        'konsumen', 'alamat', 'paket_kuota', 'berat', 'harga', 'pembayaran', 'total', 'cabang', 'status'
    ];

    public function konsumen()
    {
        return $this->belongsTo(Konsumen::class, 'konsumen');
    }
}
