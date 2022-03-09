<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeIdAndCategoryIdToProductPartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_parts', function (Blueprint $table) {
            $table->foreignId('type_id')->after('tracking_no')->nullable()->constrained();
            $table->foreignId('category_id')->after('type_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_parts', function (Blueprint $table) {
            $table->dropConstrainedForeignId('type_id');
            $table->dropConstrainedForeignId('category_id');
        });
    }
}
