<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPembeli extends Model
{
    use HasFactory;
    protected $table = 'data_pembeli';
    protected $fillable = ['nik', 'nama', 'jenis_kelamin', 'alamat', 'tempat_lahir'
    , 'tanggal_lahir', 'no_ponsel', 'gambar'];
}
