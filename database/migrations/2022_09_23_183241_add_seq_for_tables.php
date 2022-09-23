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
        Schema::table('revenue_items', function(Blueprint $table)
        {
            $table->integer('seq')->nullable(true);
        });
        Schema::table('customer_orders', function(Blueprint $table)
        {
            $table->integer('seq')->nullable(true);
        });
        Schema::table('customers', function(Blueprint $table)
        {
            $table->integer('seq')->nullable(true);
        });
        Schema::table('suppliers', function(Blueprint $table)
        {
            $table->integer('seq')->nullable(true);
        });
        Schema::table('expense_items', function(Blueprint $table)
        {
            $table->integer('seq')->nullable(true);
        });
        Schema::table('purchases', function(Blueprint $table)
        {
            $table->integer('seq')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
