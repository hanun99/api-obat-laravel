<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
         Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('Golongan');
            $table->string('Kategori');
            $table->string('Manfaat');
            $table->string('Digunakan_oleh');
            $table->string('Bentuk_Obat');
            $table->unsignedBigInteger('author');
            $table->timestamps();
            $table->softDeletes();

             $table->foreign('author')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
