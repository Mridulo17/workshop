<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatteryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('battery_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('battery_record_id')->constrained();
            $table->date('issue_date')->nullable();
            $table->string('battery_brand')->nullable();
            $table->string('battery_number')->nullable();
            $table->string('full_charge_gravity')->nullable();
            $table->date('rejected_announced_date')->nullable();
            $table->foreignId('duty_driver_employee_id')->nullable()->constrained('employees');
            $table->foreignId('sso_employee_id')->nullable()->constrained('employees');
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
        Schema::dropIfExists('battery_details');
    }
}
