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
            // We need to be able to create a leader without a civilization and vice versa
            $table->foreignId('civilization_id')->unique()->nullable()->constrained()->onDelete('cascade');
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
