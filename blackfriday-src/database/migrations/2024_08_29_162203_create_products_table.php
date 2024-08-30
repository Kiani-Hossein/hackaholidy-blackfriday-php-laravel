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
            $table->string('asin')->primary();
            $table->string('title')->nullable();
            $table->string('imgUrl')->nullable();
            $table->string('productUrl')->nullable();
            $table->decimal('stars', 2, 1)->nullable();
            $table->integer('reviews')->nullable();
            $table->decimal('price', 8, 2);
            $table->boolean('isBestSeller')->default(false);
            $table->integer('boughtInLastMonth')->nullable();
            $table->string('categoryName')->nullable();
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
