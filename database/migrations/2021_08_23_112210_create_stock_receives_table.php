<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockReceivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_receives', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_no')->nullable();
            $table->foreignId('workshop_id')->nullable()->constrained();
            $table->foreignId('fire_station_id')->nullable()->constrained();
            $table->foreignId('supplier_id')->nullable()->constrained();
            $table->dateTime('received_date')->nullable()->constrained();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->foreignId('deleted_by')->nullable()->constrained('users');
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
        Schema::dropIfExists('stock_receives');
    }
}
