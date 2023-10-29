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
            $table->string('race')->default('');
            $table->string('abilities')->default('');
            $table->string('weaknesses')->default('');
            $table->string('affiliations')->default('');
            $table->string('appearances')->default('');
            $table->longText('history')->default('');
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
