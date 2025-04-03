<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('civilizations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon');
            $table->text('dawn_of_man');
            $table->json('historical_info');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('civilizations');
    }
};
