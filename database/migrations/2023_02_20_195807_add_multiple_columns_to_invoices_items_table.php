<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoice_item_details', function (Blueprint $table) {
            //$table->integer('discount')->default(0);
            $table->integer('boxes')->nullable();
            $table->float('tax',8,2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoice_item_details', function (Blueprint $table) {
            $table->dropColumn('boxes');
            $table->dropColumn('tax');
        });
    }
};
