<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
    Schema::create('entradas', function (Blueprint $table) {
        $table->id();
        $table->string('titulo', 255);
        $table->text('contenido');
        $table->string('imagen')->nullable(); // путь к изображению
        $table->boolean('activo')->default(true);
        $table->unsignedBigInteger('user_id'); // автор

        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
    }
};
