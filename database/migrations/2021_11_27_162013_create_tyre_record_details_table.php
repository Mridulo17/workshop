<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTyreRecordDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tyre_record_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tyre_record_id')->constrained();
            $table->date('issue_date')->nullable();
            $table->string('tyre_serial_number')->nullable();
            $table->string('tyre_number')->nullable();
            $table->string('tyre_size')->nullable();
            $table->string('tyre_ply')->nullable();
            $table->foreignId('manufacturer_brand_id')->nullable()->constrained('brands');
            $table->foreignId('manufacturer_country_id')->nullable()->constrained('countries');
            $table->date('rotation_date')->nullable();
            $table->string('rotation_meter_reading')->nullable();
            $table->date('rejected_announced_date')->nullable();
            $table->string('rejected_announce_meter_reading')->nullable();
            $table->string('rejected_announce_tyre_number')->nullable();
            $table->foreignId('driver_employee_id')->nullable()->constrained('employees');
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
        Schema::dropIfExists('tyre_record_details');
    }
}
