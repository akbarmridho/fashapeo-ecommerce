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
            $table->string('service', 10)->nullable();
            $table->string('etd', 20)->nullable();
            $table->unsignedMediumInteger('weight');
            $table->decimal('price', $precision = 18, $scale = 0)->nullable();
            $table->string('tracking_number')->nullable();
            $table->string('destination_province')->nullable();
            $table->string('destination_city')->nullable();
            $table->string('destination_district')->nullable();
            $table->string('destination_delivery')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('phone')->nullable();
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
