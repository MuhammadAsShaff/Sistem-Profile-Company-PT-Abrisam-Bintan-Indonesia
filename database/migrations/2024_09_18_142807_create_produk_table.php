<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id('id_produk');
            $table->string('nama_produk');
            $table->integer('harga_produk');
            $table->string('benefit');
            $table->integer('kecepatan');
            $table->string('deskripsi');
            $table->integer('diskon')->nullable();
            $table->string('gambar_produk')->nullable();

            // Foreign key ke kategori
            $table->unsignedBigInteger('id_kategori');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onDelete('cascade');

            // Foreign key ke paket
            $table->unsignedBigInteger('id_paket');
            $table->foreign('id_paket')->references('id_paket')->on('paket')->onDelete('cascade');

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
        Schema::dropIfExists('produk');
    }
}
