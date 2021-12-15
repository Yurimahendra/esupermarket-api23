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
            $table->string('order_id')->unique();
            $table->string('nama');
            $table->string('no_hp');
            $table->string('alamat');
            $table->string('nama_barang');
            $table->bigInteger('jumlah_pesanan');
            $table->bigInteger('ongkir');
            $table->bigInteger('total_harga');
            $table->string('metode_pembayaran');
            $table->string('status');
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
