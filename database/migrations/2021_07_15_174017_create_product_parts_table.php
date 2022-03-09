<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductPartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_parts', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_no')->nullable();
            $table->foreignId('brand_id')->nullable()->constrained();
            $table->foreignId('model_id')->nullable()->constrained();
            $table->foreignId('unit_id')->nullable()->constrained();
            $table->foreignId('workshop_id')->nullable()->constrained();
            $table->foreignId('fire_station_id')->nullable()->constrained();
            $table->string('name')->nullable();
            $table->string('bn_name')->nullable();
            $table->year('manufacturer_year')->nullable();
            $table->dateTime('entry_date')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('sku')->nullable();
            $table->string('material')->nullable();
            $table->enum('material_type',['parts','liquids'])->nullable();
            $table->enum('parts',['generic','specific'])->nullable();
            $table->string('image')->nullable();
            $table->double('weight',8,2,true)->nullable();
            $table->enum('scrapable', [1, 0])->default(0)->nullable();
            $table->enum('stock_check', [1, 0])->default(0)->nullable();
            $table->integer('minimum_stock')->nullable()->default(0)->nullable();
            $table->string('section')->nullable();
            $table->string('building')->nullable();
            $table->string('floor')->nullable();
            $table->string('block')->nullable();
            $table->string('rack')->nullable();
            $table->string('row')->nullable();
            $table->string('column')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
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
        Schema::dropIfExists('product_parts');
    }
}
