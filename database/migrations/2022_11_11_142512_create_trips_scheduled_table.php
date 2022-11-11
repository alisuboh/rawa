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
        Schema::create('trips_scheduled', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->integer("provider_id");
            $table->json("orders_ids")->nullable(true);
            $table->integer("customer_id")->nullable(true);
            $table->integer("driver_id")->nullable(true);
            $table->date("delivery_date")->nullable(true);
            $table->json("days")->nullable(true);
            $table->integer("status")->default(1);
            $table->string("note")->nullable(true);
            $table->integer("app_source")->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trips_scheduled');
    }
};
