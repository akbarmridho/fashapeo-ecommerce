<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('courier_id')->constrained()->nullOnDelete();
            $table->unsignedSmallInteger('destination_id');
            $table->unsignedSmallInteger('origin_id');
            $table->string('service', 10);
            $table->string('etd', 20);
            $table->unsignedMediumInteger('weight');
            $table->decimal('price', $precision = 18, $scale = 0)->nullable();
            $table->string('tracking_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipments');
    }
}
