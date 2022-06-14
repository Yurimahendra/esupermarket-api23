<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataOrderan extends Model
{
    use HasFactory;
    protected $table = 'data_orderan';
    protected $fillable = ['id_pesanan', 'nama', 'no_hp', 'alamat', 'latitude', 'longitude', 'nama_barang', 'merk_barang', 'harga_barang', 'jumlah_pesanan', 'satuan', 'gambar', 'tanggal_pengiriman', 'ongkir'
    , 'total_harga', 'metode_pembayaran', 'status', 'status_pesanan', 'bukti_transfer'];
}
