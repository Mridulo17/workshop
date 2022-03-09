<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatteryRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('battery_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained();
            $table->string('tracking_no');
            $table->string('entry_type')->default('manual');
            $table->string('battery_size_length')->nullable();
            $table->string('battery_size_width')->nullable();
            $table->string('battery_size_height')->nullable();
            $table->string('battery_numbers')->nullable();
            $table->string('battery_plate')->nullable();
            $table->string('battery_ampere')->nullable();
            $table->enum('status',['Active','Inactive'])->default('Active');
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
        Schema::dropIfExists('battery_records');
    }
}
