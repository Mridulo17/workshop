<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKmplLphDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kmpl_lph_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kmpl_lph_record_id')->constrained();
            $table->date('exam_date')->nullable();
            $table->foreignId('examiner_employee_id')->nullable()->constrained('employees');
            $table->foreignId('examiner_designation_id')->nullable()->constrained('designations');
            $table->string('result_kmpl')->nullable();
            $table->string('result_lph')->nullable();
            $table->string('examiner_signature')->nullable();
            $table->string('driver_signature')->nullable();
            $table->string('sso_so_signature')->nullable();
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
        Schema::dropIfExists('kmpl_lph_details');
    }
}
