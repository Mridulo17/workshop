<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMenuActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_menu_actions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('menu_id')->constrained();
            $table->foreignId('menu_action_id')->nullable()->constrained();
            $table->string('name')->nullable();
            $table->string('bn_name')->nullable();
            $table->string('route_name')->nullable();
            $table->string('type')->default('action');
            $table->string('slug')->nullable();
            $table->integer('order_by')->nullable();
            $table->enum('is_hidden', ['Yes', 'No'])->nullable()->default('No');
            $table->integer('show_in_table')->nullable();
            $table->integer('new_tab')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('user_menu_actions');
    }
}
