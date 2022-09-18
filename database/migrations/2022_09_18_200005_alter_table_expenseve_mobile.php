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
        Schema::table('expense_items', function(Blueprint $table)
        {
            $table->string('beneficiary_mobile')->nullable(true);
            $table->string('description')->nullable(true)->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expense_items', function(Blueprint $table)
        {
            $table->dropColumn('beneficiary_mobile');
        

        });
    }
};
