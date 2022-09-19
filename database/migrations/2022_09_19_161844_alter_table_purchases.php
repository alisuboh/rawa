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
        Schema::table('purchases', function(Blueprint $table)
        {
            $table->integer('supplier_id')->nullable(true)->change();
            $table->decimal('price',8, 2)->nullable(true)->change();
            $table->decimal('tax',8, 2)->nullable(true)->change();
            $table->decimal('discount',8, 2)->nullable(true)->change();


        });

        Schema::table('purchases_details', function(Blueprint $table)
        {
            $table->string('note')->nullable(true)->change();
            $table->decimal('tax',8, 2)->nullable(true)->change();
            $table->decimal('discount',8, 2)->nullable(true)->change();


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
