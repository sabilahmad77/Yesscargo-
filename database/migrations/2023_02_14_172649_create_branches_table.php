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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            //$table->string('users_id')->required();
            $table->bigInteger('users_id')->unsigned()->nullable()->comment('branch_user_id');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('set null');
            $table->string('branch_name')->required();
            $table->string('invoicing_serial')->default('000');
            //$table->string('email')->required();
            //$table->string('password')->required();
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
        Schema::dropIfExists('branches');
    }
};
