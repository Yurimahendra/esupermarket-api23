<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataProduk extends Model
{
    use HasFactory;
    protected $table = 'data_produk';
    protected $fillable = ['nama_barang', 'merk', 'harga', 'satuan', 'stok', 'gambar', 'deskripsi'];
}
