<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataOrderanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_orderan', function (Blueprint $table) {
            $table->id();
            $table->string('id_pesanan')->unique();
            $table->string('nama');
            $table->string('no_hp');
            $table->string('alamat');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('nama_barang');
            $table->string('merk_barang');
            $table->string('harga_barang');
            $table->bigInteger('jumlah_pesanan');
            $table->string('satuan');
            $table->string('gambar')->nullable();
            $table->string('tanggal_pengiriman');
            $table->string('ongkir')->nullable();
            $table->string('total_harga');
            $table->string('metode_pembayaran');
            $table->string('status')->nullable();
            $table->string('status_pesanan')->nullable();
            $table->string('bukti_transfer')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_orderan');
    }
}
