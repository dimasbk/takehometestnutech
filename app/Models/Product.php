<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'nama_produk', 'id_kategori', 'harga_beli', 'harga_jual', 'stok', 'image_name'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_kategori', 'id');
    }
}
