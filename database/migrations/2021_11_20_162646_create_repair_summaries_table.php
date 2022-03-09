<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepairSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repair_summaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('workshop_employee_id')->nullable()->constrained('employees');
            $table->string('workshop_employee_signature')->nullable();
            $table->string('tracking_no');
            $table->string('entry_type')->default('manual');
            $table->string('job_number')->nullable();
            $table->date('in_date')->nullable();
            $table->string('in_mileage')->nullable();
            $table->date('out_date')->nullable();
            $table->string('out_mileage')->nullable();
            $table->enum('status',['Active','Inactive']);
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
        Schema::dropIfExists('repair_summaries');
    }
}
