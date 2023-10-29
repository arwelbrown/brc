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
        Schema::create('series', function (Blueprint $table) {
            $table->id()->index();
            $table->string('series_name');
            $table->string('creators')->default('');
            $table->string('writers')->default('');
            $table->string('editors')->default('');
            $table->string('artists')->default('');
            $table->string('letterers')->default('');
            $table->string('colorists')->default('');
            $table->longText('series_description');
            $table->string('series_slug');
            $table->string('series_banner');
            $table->string('spin_offs')->nullable();
            $table->foreignId('universe_id')->constrained('universes')->cascadeOnDelete()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('series');
    }
};
