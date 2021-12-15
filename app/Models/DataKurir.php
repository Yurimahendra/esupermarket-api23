<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKurir extends Model
{
    use HasFactory;
    protected $table = 'data_kurir';
    protected $fillable = ['nik', 'nama', 'jenis_kelamin', 'alamat', 'tempat_lahir'
    , 'tanggal_lahir', 'no_ponsel', 'gambar'];
}
