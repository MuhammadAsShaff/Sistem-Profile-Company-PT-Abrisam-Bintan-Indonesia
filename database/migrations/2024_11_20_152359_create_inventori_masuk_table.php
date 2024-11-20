<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inventory_masuk', function (Blueprint $table) {
            $table->id('id_inventoryMasuk'); // Primary key
            $table->string('kategoriProduk')->unique(); // Kategori produk unik
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_masuk'); // Hapus tabel jika rollback
    }
};
