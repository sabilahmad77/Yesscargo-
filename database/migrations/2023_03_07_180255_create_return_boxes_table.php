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
        Schema::create('return_boxes', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('branch_id')->unsigned()->nullable()->comment('branch_id');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');

            $table->bigInteger('invoices_id')->unsigned()->nullable()->comment('invoice_id');
            $table->foreign('invoices_id')->references('id')->on('invoices')->onDelete('cascade');

            $table->bigInteger('invoice_item_details_id')->unsigned()->nullable()->comment('invoice_item_details_id');
            $table->foreign('invoice_item_details_id')->references('id')->on('invoice_item_details')->onDelete('cascade');

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
        Schema::dropIfExists('return_boxes');
    }
};
