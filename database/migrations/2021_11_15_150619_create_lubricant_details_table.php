<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLubricantDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lubricant_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lubricant_record_id')->constrained();
            $table->string('mobil_oil')->nullable();
            $table->string('gear_oil')->nullable();
            $table->string('brake_oil')->nullable();
            $table->string('hydraulic_oil')->nullable();
            $table->string('grease')->nullable();
            $table->string('substitutor_signature')->nullable();
            $table->foreignId('substitutor_employee_id')->nullable()->constrained('employees');
            $table->date('substitutor_date')->nullable();
            $table->string('sso_signature')->nullable();
            $table->foreignId('sso_employee_id')->nullable()->constrained('employees');
            $table->date('sso_date')->nullable();
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
        Schema::dropIfExists('lubricant_details');
    }
}
