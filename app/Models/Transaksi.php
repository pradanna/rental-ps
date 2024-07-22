<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    //status note
    // 0 menunggu pembayaran
    // 1 menunggu konfirmasi pembayaran
    // 2 pembayaran di tolak
    // 3 menunggu di ambil
    // 4 sedang meminjam
    // 5 selesai

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

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class, 'transaksi_id');
    }

    public function pembayaran_status()
    {
        return $this->hasOne(Pembayaran::class, 'transaksi_id')->orderBy('created_at', 'DESC');
    }
}
