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
        Schema::create('branch_clients', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('branches_id')->unsigned()->nullable();
            $table->foreign('branches_id')->references('id')->on('branches')->onDelete('set null');
            $table->string('name')->required();
            $table->string('email')->nullable();
            $table->string('city')->nullable();
            $table->string('pincode')->nullable();
            $table->string('phone1')->required();
            $table->string('phone2')->nullable();
            $table->longText('address')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('branch_clients');
    }
};
