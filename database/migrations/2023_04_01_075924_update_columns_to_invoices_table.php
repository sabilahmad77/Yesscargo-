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
            $table->string('sales_person');
            $table->string('invoice_note')->nullable()->change();
            $table->string('cosignee_email')->nullable()->change();
            $table->string('cosignee_phone1')->nullable()->change();
            $table->string('box_charges')->nullable()->change();
            $table->string('other_charges')->nullable()->change();
            $table->string('packing_charges')->nullable()->change();
            $table->string('bill_charges')->nullable()->change();
            $table->string('total')->nullable()->change();
            $table->string('discount')->nullable()->change();
            $table->string('vat')->nullable()->change();
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
            $table->dropColumn('sales_person');
        });
    }
};
