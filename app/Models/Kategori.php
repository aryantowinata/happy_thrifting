<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori'; // Nama tabel

    protected $fillable = [
        'nama_kategori',
        'gambar_kategori',
    ];

    // Relasi dengan model Produk
    public function products()
    {
        return $this->hasMany(Product::class, 'kategori_produk', 'nama_kategori');
    }
}
