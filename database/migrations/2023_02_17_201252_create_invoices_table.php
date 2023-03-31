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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id(); 
            $table->bigInteger('invoice_no')->required();
           //$table->string('cust_name')->required();
           //$table->string('cust_email')->nullable();
           //$table->string('cust_phone')->nullable();
           //$table->longText('cust_address')->nullable();

           //$table->string('sales_person')->required();
           $table->date('due_date')->nullable();
           $table->longText('invoice_note')->nullable();

           $table->float('sub_total', 8, 2)->required();
           $table->float('discount', 8, 2)->required();
           $table->float('tax', 8, 2)->required();
           $table->float('total', 8, 2)->required();
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
        Schema::dropIfExists('invoices');
    }
};
