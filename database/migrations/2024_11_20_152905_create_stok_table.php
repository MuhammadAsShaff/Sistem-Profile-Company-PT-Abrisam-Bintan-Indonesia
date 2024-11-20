<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('stock', function (Blueprint $table) {
            $table->id('id_stock'); // Primary key untuk tabel stock
            $table->string('namaProduk');
            $table->string('nomorProduk')->unique();

            // Foreign key ke tabel inventory_masuk
            $table->unsignedBigInteger('id_inventoryMasuk')->nullable();
            $table->foreign('id_inventoryMasuk')
                ->references('id_inventoryMasuk')
                ->on('inventory_masuk')
                ->onDelete('cascade');

            // Foreign key ke tabel inventory_keluar
            $table->unsignedBigInteger('id_inventoryKeluar')->nullable();
            $table->foreign('id_inventoryKeluar')
                ->references('id_inventoryKeluar')
                ->on('inventory_keluar')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('stock');
    }

};
