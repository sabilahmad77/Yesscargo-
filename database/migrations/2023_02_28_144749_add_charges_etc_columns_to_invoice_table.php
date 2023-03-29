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
        Schema::table('invoices', function (Blueprint $table) {

            $table->float('bill_charges', 8, 2)->default(0.00);
            $table->float('other_charges', 8, 2)->default(0.00);
            $table->integer('discount')->default(0);
            $table->integer('vat')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {

            $table->dropColumn('bill_charges');
            $table->dropColumn('other_charges');
            $table->dropColumn('discount');
            $table->dropColumn('vat');

        });
    }
};
