<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilterChangeDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filter_change_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('filter_change_record_id')->constrained();
            $table->string('mobil_filter')->nullable();
            $table->string('diesel_filter')->nullable();
            $table->string('air_filter')->nullable();
            $table->date('change_date')->nullable();
            $table->foreignId('substitutor_employee_id')->nullable()->constrained('employees');
            $table->string('substitutor_signature')->nullable();
            $table->date('substitutor_date')->nullable();
            $table->foreignId('sso_employee_id')->nullable()->constrained('employees');
            $table->string('sso_signature')->nullable();
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
        Schema::dropIfExists('filter_change_details');
    }
}
