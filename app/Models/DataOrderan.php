<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataOrderan extends Model
{
    use HasFactory;
    protected $table = 'data_orderan';
    protected $fillable = ['order_id', 'nama', 'no_hp', 'alamat', 'nama_barang', 'jumlah_pesanan','ongkir'
    , 'total_harga', 'metode_pembayaran', 'status'];
}
