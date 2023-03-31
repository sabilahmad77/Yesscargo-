<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->date('starting_date')->nullable();
        });
    }

    
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            Schema::dropColumns('starting_date');
        });
    }
};
