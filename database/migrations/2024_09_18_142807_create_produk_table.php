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
            $table->id('id_produk'); // Primary key

            // Kolom sesuai dengan model
            $table->string('nama_produk'); // Nama produk
            $table->integer('harga_produk'); // Harga produk
            $table->json('benefit'); // Benefit produk
            $table->integer('kecepatan'); // Kecepatan internet
            $table->text('deskripsi'); // Deskripsi produk
            $table->integer('diskon')->nullable(); // Diskon produk
            $table->integer('biaya_pasang')->nullable(); // Biaya pemasangan
            $table->integer('kuota')->nullable(); // Kuota, mungkin bergantung pada tipe produk

            // Foreign key ke kategori
            $table->unsignedBigInteger('id_kategori');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onDelete('cascade');

            // Foreign key ke paket
            $table->unsignedBigInteger('id_paket');
            $table->foreign('id_paket')->references('id_paket')->on('paket')->onDelete('cascade');

            $table->timestamps(); // Timestamps for created_at and updated_at
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
