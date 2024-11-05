<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaganTable extends Migration
{
    public function up()
    {
        Schema::create('bagan', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title');
            $table->string('img_url')->nullable();
            $table->foreignId('parent_id')->nullable()->constrained('bagan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bagan');
    }
}
