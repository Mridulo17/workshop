<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockReceiveItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_receive_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stock_receive_id')->constrained()->cascadeOnDelete();
            $table->foreignId('model_id')->nullable()->constrained();
            $table->morphs('itemable');
            $table->string('type');
            $table->bigInteger('order_qty')->nullable()->default(0);
            $table->bigInteger('received_qty')->nullable()->default(0);
            $table->bigInteger('current_qty')->nullable()->default(0);
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->foreignId('deleted_by')->nullable()->constrained('users');
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
        Schema::dropIfExists('stock_receive_items');
    }
}
