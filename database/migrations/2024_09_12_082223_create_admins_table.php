<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id(); // Primary key ID
            $table->string('email_admin', 150)->unique(); // Email admin harus unik
            $table->string('nama_admin', 100);
            $table->string('password');
            $table->string('posisi', 100);
            $table->string('foto_admin')->nullable();
            $table->string('status')->default('Offline');
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
        Schema::dropIfExists('admins');
    }
}
