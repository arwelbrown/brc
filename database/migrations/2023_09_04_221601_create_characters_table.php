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
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->string('real_name');
            $table->string('name');
            $table->string('aliases');
            $table->string('race');
            $table->string('abilities');
            $table->string('weaknesses');
            $table->string('affiliations');
            $table->string('appearances');
            $table->longText('history');
            $table->string('img_string');
            $table->foreignId('series_id')->constrained('series')->cascadeOnDelete()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};
