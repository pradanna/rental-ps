<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_id',
        'nama',
        'harga',
        'qty',
        'deskripsi',
        'gambar'
    ];

    protected $appends = [
        'on_rent'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function carts()
    {
        return $this->hasMany(Keranjang::class,'product_id');
    }

    public function active_cart()
    {
        return $this->hasOne(Keranjang::class)->with(['transaction'])
//            ->whereHas('transaction', function ($q){
//                /** @var Builder $q */
//                return $q->whereIn('status', [3, 4]);
//            })
            ->orderBy('created_at', 'DESC');
    }

    public function getOnRentAttribute()
    {
        if ($this->active_cart()->first() === null) {
            return null;
        }
        return $this->active_cart()->first()->transaction;
    }
}
