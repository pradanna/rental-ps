<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'members';

    protected $fillable = [
        'user_id',
        'nama',
        'no_hp',
        'alamat',
        'gambar_ktp'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
