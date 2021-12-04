<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTokoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toko', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('nama_toko');
            $table->string('alamat');
            $table->string('kotakabupaten');
            $table->string('no_rek');
            $table->string('provider_rek');
            $table->string('nama_rek');
            $table->float('rating')->default(0);;
            $table->integer('follower')->default(0);;
            $table->string('kontak');
            $table->string('url_gmaps');
            $table->string('logo_toko');
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
        Schema::dropIfExists('toko');
    }
}
