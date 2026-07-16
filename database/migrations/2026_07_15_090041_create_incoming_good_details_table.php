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
        Schema::create('incoming_good_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('incoming_good_id')
                ->constrained('incoming_goods')
                ->cascadeOnDelete();
            $table->foreignId('product_id')
                  ->constrained('products')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->integer('quantity');
            $table->decimal('purchase_price',12,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incoming_good_details');
    }
};
