<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmployerIdAndWorkshopIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            DB::statement("ALTER TABLE `users` CHANGE `division_id` `division_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL AFTER `role_id`");
            DB::statement("ALTER TABLE `users` CHANGE `district_id` `district_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL AFTER `division_id`");
            DB::statement("ALTER TABLE `users` CHANGE `fire_station_id` `fire_station_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL AFTER `district_id`");

            $table->foreignId('employer_id')->nullable()->after('fire_station_id')->constrained('employees');
            $table->foreignId('workshop_id')->nullable()->after('employer_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            DB::statement("ALTER TABLE `users` CHANGE `division_id` `division_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL AFTER `updated_at`");
            DB::statement("ALTER TABLE `users` CHANGE `district_id` `district_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL AFTER `division_id`");
            DB::statement("ALTER TABLE `users` CHANGE `fire_station_id` `fire_station_id` BIGINT(20) UNSIGNED NULL DEFAULT NULL AFTER `district_id`");
            $table->dropConstrainedForeignId('employer_id');
            $table->dropConstrainedForeignId('workshop_id');
        });
    }
}
