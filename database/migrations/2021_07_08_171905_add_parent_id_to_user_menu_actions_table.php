<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddParentIdToUserMenuActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_menu_actions', function (Blueprint $table) {
            $table->foreignId('parent_id')->nullable()->after('menu_action_id')->constrained('user_menu_actions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_menu_actions', function (Blueprint $table) {
            $table->dropColumn(['parent_id']);
        });
    }
}
