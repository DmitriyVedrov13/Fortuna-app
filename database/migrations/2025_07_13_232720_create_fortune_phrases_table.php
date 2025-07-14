<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFortunePhrasesTable extends Migration
{
    public function up(): void
    {
        Schema::create('fortune_phrases', function (Blueprint $table) {
            $table->id();
            $table->text('phrase')->unique();
            $table->timestamps(); // создаёт created_at и updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fortune_phrases');
    }
}
