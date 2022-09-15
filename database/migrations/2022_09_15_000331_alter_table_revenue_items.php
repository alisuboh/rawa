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
            $table->date('transaction_date')->nullable(true);
            $table->double('total_price')->nullable(true);
            $table->string('bond_no')->nullable(true);
            $table->string('code')->nullable(true);


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('revenue_items', function(Blueprint $table)
        {
            $table->dropColumn('transaction_date');
            $table->dropColumn('total_price');
            $table->dropColumn('bond_no');
            $table->dropColumn('code');

        });
    }
};
