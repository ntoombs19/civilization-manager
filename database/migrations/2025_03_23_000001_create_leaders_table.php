<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leaders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('civilization_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('subtitle');
            $table->string('lived');
            $table->string('icon');
            $table->json('trait');
            $table->json('titles');
            $table->json('historical_info');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leaders');
    }
};
