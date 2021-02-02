<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->nullOnDelete();
            $table->string('name');
            $table->longText('description');
            $table->string('slug');
            $table->unsignedInteger('sold')->default(0);
            $table->unsignedInteger('weight');
            $table->unsignedTinyInteger('width')->nullable();
            $table->unsignedTinyInteger('height')->nullable();
            $table->unsignedTinyInteger('length')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_products');
    }
}
