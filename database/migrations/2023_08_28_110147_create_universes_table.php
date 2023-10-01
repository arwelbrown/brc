<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('universes', function (Blueprint $table) {
            $table->id();
            $table->string('universe_name');
            $table->string('universe_slug');
            $table->string('universe_summary');
            $table->string('universe_description');
            $table->string('img_string');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('universes');
    }
};
