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

        $table->id();
        $table->foreignId('category_id')
              ->constrained('categories')
              ->cascadeOnUpdate()
              ->restrictOnDelete();
        $table->string('product_code',20)->unique();
        $table->string('product_name',100);
        $table->foreignId('unit_id')
      ->constrained('units')
      ->cascadeOnUpdate()
      ->restrictOnDelete();
        $table->decimal('purchase_price',12,2);
        $table->integer('stock')->default(0);
        $table->integer('minimum_stock')->default(10);
        $table->string('image')->nullable();
        $table->text('description')->nullable();
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
