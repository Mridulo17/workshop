<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyTransitDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_transit_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('monthly_transit_id')->constrained();
            $table->string('month',40)->nullable();
            $table->string('kmpl_lph_per_month')->nullable();
            $table->string('fuel_cost')->nullable();
            $table->string('lubricant_cost')->nullable();
            $table->string('kmpl_lph_per_liter')->nullable();
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
        Schema::dropIfExists('monthly_transit_details');
    }
}
