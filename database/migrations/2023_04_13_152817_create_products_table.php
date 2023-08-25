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
        Schema::create('products', function (Blueprint $table) {
            $table->id()->index();
            $table->string('product_name');
            $table->string('series')->nullable();
            $table->string('tags')->nullable();
            $table->string('ejunkie_link_digital')->nullable();
            $table->string('ejunkie_link_physical')->nullable();
            $table->foreignId('publisher_id')->constrained('publishers')->cascadeOnDelete();
            $table->longText('summary');
            $table->float('digital_price')->nullable();
            $table->float('physical_price')->nullable();
            $table->string('img_string');
            $table->integer('in_development');
            $table->integer('physical_available');
            $table->string('store_slug');
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
