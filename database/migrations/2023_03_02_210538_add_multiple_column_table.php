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
//        Schema::table('invoices', function (Blueprint $table) {
//
//            $table->string('cosignee_name')->required();
//            $table->string('cosignee_email')->required();
//            $table->string('cosignee_phone1')->required();
//            $table->string('cosignee_phone2')->nullable();
//            $table->string('cosignee_pincode')->nullable();
//            $table->string('cosignee_city')->required();
//            $table->longText('cosignee_address')->required();
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            Schema::dropIfExists('cosignee_name');
            Schema::dropIfExists('cosignee_email');
            Schema::dropIfExists('cosignee_phone1');
            Schema::dropIfExists('cosignee_phone2');
            Schema::dropIfExists('cosignee_pincode');
            Schema::dropIfExists('cosignee_city');
            Schema::dropIfExists('cosignee_address');

        });
    }
};
