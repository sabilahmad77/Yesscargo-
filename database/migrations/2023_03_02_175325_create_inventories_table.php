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
        if (!Schema::hasTable('inventories')) {
            Schema::create('inventories', function (Blueprint $table) {
                $table->id();

                $table->bigInteger('categories_id')->unsigned()->required()->comment('categories_id');
                $table->foreign('categories_id')->references('id')->on('categories')->onDelete('cascade');

                $table->bigInteger('branch_id')->unsigned()->required()->comment('branch-id');
                $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');

                $table->string('name')->required();
                $table->string('paid_to')->required();
                $table->float('amount', 8, 2)->default(0.00);

                $table->string('paid_to_email')->nullable();
                $table->string('paid_to_phone1')->nullable();
                $table->string('paid_to_phone2')->nullable();
                $table->string('short_description')->nullable();
                $table->string('description')->required();
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventories');
    }
};
