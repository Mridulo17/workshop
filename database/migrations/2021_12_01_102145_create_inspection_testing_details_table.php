<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectionTestingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspection_testing_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inspection_testing_id')->constrained();
            $table->foreignId('visitor_employee_id')->nullable()->constrained('employees');
            $table->foreignId('visitor_designation_id')->nullable()->constrained('designations');
            $table->foreignId('visitor_helper_employee_id')->nullable()->constrained('employees');
            $table->foreignId('visitor_helper_designation_id')->nullable()->constrained('designations');
            $table->string('fill_inspection_book')->nullable();
            $table->string('fill_inspection_seat_number')->nullable();
            $table->string('inspection_short_remarks')->nullable();
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
        Schema::dropIfExists('inspection_testing_details');
    }
}
