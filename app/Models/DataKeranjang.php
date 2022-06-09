<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKeranjang extends Model
{
    use HasFactory;
    protected $table = 'data_keranjang';
    protected $fillable = ['nama_barang', 'merk', 'harga', 'satuan', 'min_belanja', 'ongkir', 'gambar', 'deskripsi'];
}
