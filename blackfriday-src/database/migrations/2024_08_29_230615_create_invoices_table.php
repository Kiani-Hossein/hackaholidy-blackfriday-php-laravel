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
        Schema::create('Invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('BasketId')->constrained('baskets', 'BasketId');
            $table->unsignedBigInteger('UserId');
            $table->json('Items');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Invoices', function (Blueprint $table) {
            $table->dropForeign('BasketId');
            $table->dropForeign('UserId');
        });

        Schema::dropIfExists('Invoices');
    }
};
