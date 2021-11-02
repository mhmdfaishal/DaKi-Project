<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateGunungTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gunung', function (Blueprint $table) {
            $table->id();
            $table->string('nama_gunung');
            $table->string('gambar_gunung');
            $table->string('lokasi');
            $table->string('status');
            $table->string('ketinggian');
            $table->string('htm');
            $table->string('kuota_pendaki');
            $table->string('kontak');
            $table->string('url_gmaps');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gunung');
    }
}
