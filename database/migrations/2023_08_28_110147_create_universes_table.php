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
            $table->string('universe_summary')->nullable();
            $table->string('universe_description')->nullable();
            $table->string('universe_banner_img_string');
            $table->string('universe_background_img_string')->nullable();
            $table->string('universe_logo_img_string')->nullable();
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
