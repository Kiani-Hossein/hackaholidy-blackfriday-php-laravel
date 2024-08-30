<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('baskets', function (Blueprint $table) {
            $table->id('BasketId');
            $table->foreignId('ProductId')->constrained('products', 'asin');
            $table->foreignId('UserId')->constrained('users', 'id');
            $table->boolean('IsCheckedOut')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('baskets', function (Blueprint $table) {
            $table->dropForeign('Baskets_ProductId_foreign');
        });

        Schema::dropIfExists('baskets');
    }
};
