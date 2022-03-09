<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepairJobCardDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repair_job_card_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('repair_job_card_id')->constrained();
            $table->string('fault')->nullable();
            $table->string('repair_work')->nullable();
            $table->string('product_part_id')->nullable();
            $table->string('amount')->nullable();
            $table->string('receipt_place');
            $table->string('unit')->nullable();
            $table->string('total')->nullable();
            $table->string('manpower_number_type')->nullable();
            $table->string('total_manpower_cost')->nullable();
            $table->string('total_cost')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('repair_job_card_details');
    }
}
