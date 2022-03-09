<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_no')->nullable();
            $table->foreignId('type_id');
            $table->foreignId('category_id')->nullable();
            $table->foreignId('brand_id')->nullable()->constrained();
            $table->foreignId('model_id')->nullable()->constrained();
            $table->foreignId('country_id')->nullable()->constrained('countries');
            $table->foreignId('workshop_id')->nullable()->constrained();
            $table->foreignId('fire_station_id')->nullable()->constrained();
            $table->string('name')->nullable();
            $table->string('bn_name')->nullable();
            $table->string('sku')->nullable();
            $table->year('manufacturer_year')->nullable();
            $table->dateTime('entry_date')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('divisional_number')->nullable();
            $table->string('engine_number')->nullable();
            $table->string('chassis_number')->nullable();
            $table->string('cylinder_number')->nullable();
            $table->string('capacity')->nullable();
            $table->string('fuel')->nullable();
            $table->double('weight',10,2,true)->nullable();
            $table->double('volume',10,2,true)->nullable();
            $table->double('horsepower',10,2,true)->nullable();
            $table->integer('tire_size')->nullable();
            $table->integer('tire_number')->nullable();
            $table->integer('minimum_stock')->nullable();
            $table->enum('stock_check', [1, 0])->default(1);
            $table->enum('scrapable', [1, 0])->default(0);
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
        Schema::dropIfExists('products');
    }
}
