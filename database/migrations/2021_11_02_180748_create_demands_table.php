<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDemandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demands', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inspection_report_id')->constrained();
            $table->string('fault');
            $table->foreignId('fault_type_id');
            $table->foreignId('fault_category_id');
            $table->foreignId('fault_brand_id');
            $table->foreignId('fault_model_id');
            $table->foreignId('product_part_id');
            $table->string('repair_work')->nullable();
            $table->string('amount');
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('demands');
    }
}
