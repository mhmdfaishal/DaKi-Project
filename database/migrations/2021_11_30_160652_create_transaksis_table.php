<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('no_transaksi');
            $table->integer('toko_id');
            $table->string('user_id');
            $table->integer('total_harga');
            $table->string('bukti_pembayaran');
            $table->datetime('tangal_mulai_penyewaan');
            $table->datetime('taggal_selesai_penyewaan');
            $table->string('total_hari');
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
        Schema::dropIfExists('transaksis');
    }
}
