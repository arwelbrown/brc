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
        Schema::create('books', function (Blueprint $table) {
            $table->id()->index();
            $table->string('name');
            $table->foreignId('series_id')->constrained('series')->cascadeOnDelete()->default(0);
            $table->string('tags')->nullable();
            $table->string('ejunkie_link_digital')->nullable();
            $table->string('ejunkie_link_physical')->nullable();
            $table->longText('summary');
            $table->float('digital_price')->nullable();
            $table->float('physical_price')->nullable();
            $table->string('img_string');
            $table->integer('in_development');
            $table->integer('physical_available');
            $table->string('store_slug');
            $table->integer('active')->default(0);
            $table->integer('featured_product')->default(0);
            $table->integer('stock')->nullable();
            $table->tinyInteger('brc_book')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
