<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverRecordDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_record_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_record_id')->constrained();
            $table->foreignId('driver_employee_id')->constrained('employees');
            $table->date('in_date')->nullable();
            $table->string('in_meter_reading')->nullable();
            $table->date('out_date')->nullable();
            $table->string('out_meter_reading')->nullable();
            $table->string('driver_signature')->nullable();
            $table->foreignId('sso_so_employee_id')->nullable()->constrained('employees');
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
        Schema::dropIfExists('driver_record_details');
    }
}
