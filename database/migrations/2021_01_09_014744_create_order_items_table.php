<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->nullOnDelete();
            $table->foreignId('product_discount_id')->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('variant')->nullable();
            $table->string('note')->nullable();
            $table->unsignedSmallInteger('quantity');
            $table->decimal('price', $precision = 18, $scale = 0);
            $table->decimal('price_cut', $precision = 18, $scale = 0)->nullable();
            $table->decimal('final_price', $precision = 18, $scale = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
