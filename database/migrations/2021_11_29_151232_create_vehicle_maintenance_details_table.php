<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleMaintenanceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_maintenance_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_maintenance_order_id')->constrained();
            $table->string('serial_number')->nullable();
            $table->string('subject')->nullable();
            $table->foreignId('order_giving_employee_id')->nullable()->constrained('employees');
            $table->string('memorandum_number')->nullable();
            $table->date('memorandum_date')->nullable();
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
        Schema::dropIfExists('vehicle_maintenance_details');
    }
}
