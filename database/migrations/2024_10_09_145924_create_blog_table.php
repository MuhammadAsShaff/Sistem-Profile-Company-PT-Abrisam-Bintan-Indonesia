<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog', function (Blueprint $table) {
            $table->id('id_blog'); // Primary key
            $table->string('judul_blog'); // Judul blog
            $table->string('slug'); // Judul blog
            $table->mediumText('isi_blog'); // Isi blog
            $table->string('kategori', 100);
            $table->string('gambar_cover')->nullable(); // Gambar cover (optional)
            $table->timestamp('tanggal_penulisan')->useCurrent(); // Tanggal penulisan
            $table->timestamps(); // Created_at and Updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog');
    }
}
