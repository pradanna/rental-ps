<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $fillable = [
        'nama',
        'gambar'
    ];

    public function product()
    {
        return $this->hasMany(Product::class, 'kategori_id');
    }

    public function getCountProductAttribute()
    {
        return $this->product()->count();
    }
}
