<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropCourierIdFromShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shipments', function (Blueprint $table) {
            $table->dropColumn('courier_id');
            $table->string('courier')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shipments', function (Blueprint $table) {
            $table->dropColumn('courier');
            $table->foreignId('courier_id')->constrained()->nullOnDelete();
        });
    }
}
