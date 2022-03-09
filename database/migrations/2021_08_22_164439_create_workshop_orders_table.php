<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkshopOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshop_orders', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_no');
            $table->foreignId('workshop_id')->constrained();
            $table->string('product_type');
            $table->foreignId('product_id')->constrained();
            $table->string('mileage');
            $table->string('fuel_type');
            $table->string('fuel');
            $table->foreignId('driver_id')->constrained();
            $table->date('order_date');
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
        Schema::dropIfExists('workshop_orders');
    }
}
