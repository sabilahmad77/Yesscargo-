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
        Schema::create('invoice_item_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('invoices_id')->unsigned()->nullable()->comment('invoice-id');
            $table->foreign('invoices_id')->references('id')->on('invoices')->onDelete('set null');
            $table->string('item_name')->required();
            $table->string('quantity')->default('1');
            $table->float('item_per_cost', 8, 2)->required();
            $table->float('weight', 8, 2)->default(0);
            $table->float('price', 8, 2)->required();
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
        Schema::dropIfExists('invoice_item_details');
    }
};
