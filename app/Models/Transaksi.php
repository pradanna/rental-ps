<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'user_id',
        'no_peminjaman',
        'tanggal_pinjam',
        'tanggal_kembali',
        'sub_total',
        'dp',
        'denda',
        'total',
        'lunas',
        'status',
        'alamat'
    ];

    protected $casts = [
        'lunas' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getKekuranganAttribute()
    {
        return $this->total - $this->dp;
    }
}
