<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // ID sesi sebagai primary key
            $table->unsignedBigInteger('user_id')->nullable(); // ID admin dari tabel `admins`
            $table->string('ip_address', 45)->nullable(); // Tambahkan kolom ip_address
            $table->text('user_agent')->nullable(); // Kolom user_agent
            $table->text('payload');
            $table->integer('last_activity');
            $table->foreign('user_id')->references('id')->on('admins')->onDelete('set null'); // Hubungkan ke tabel admins
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sessions', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('sessions');
    }
}
