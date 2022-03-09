<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleTransferDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_transfer_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_transfer_id')->constrained();
            $table->foreignId('order_designation_id')->nullable()->constrained('designations');
            $table->string('order_number')->nullable();
            $table->date('order_date')->nullable();
            $table->foreignId('from_employee_id')->nullable()->constrained('employees');
            $table->foreignId('from_employee_designation_id')->nullable()->constrained('designations');
            $table->string('from_employee_signature')->nullable();
            $table->foreignId('from_fire_station_id')->nullable()->constrained('fire_stations');
            $table->foreignId('to_employee_id')->nullable()->constrained('employees');
            $table->foreignId('to_employee_designation_id')->nullable()->constrained('designations');
            $table->string('to_employee_signature')->nullable();
            $table->foreignId('to_fire_station_id')->nullable()->constrained('fire_stations');
            $table->date('transfer_date')->nullable();
            $table->enum('status',['Active','Inactive'])->default('Active');
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
        Schema::dropIfExists('vehicle_transfer_details');
    }
}
