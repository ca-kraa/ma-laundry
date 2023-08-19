<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsumen extends Model
{
    use HasFactory;

    protected $table = 'konsumens';
    protected $fillable = [
        'title',
        'nama_depan',
        'nama_belakang',
        'username',
        'pin',
        'nomor_hp',
        'alamat',
        'photo',
        'status',
    ];
    public function pakets()
    {
        return $this->hasMany(Paket::class, 'konsumen');
    }
}
