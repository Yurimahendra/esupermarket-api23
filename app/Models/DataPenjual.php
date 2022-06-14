<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPenjual extends Model
{
    use HasFactory;
    protected $table = 'data_penjual';
    protected $fillable = ['nik', 'nama', 'jenis_kelamin', 'alamat', 'latitude', 'longitude', 'tempat_lahir'
    , 'tanggal_lahir', 'no_ponsel', 'nama_toko', 'nama_bank', 'no_rekening', 'gambar'];
}
