<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesProcessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_process', function (Blueprint $table) {
            $table->id('sales_id');
            $table->bigInteger('customer_id');
            $table->integer('sales_code');
            $table->date('sales_date');
            $table->bigInteger('alqor_product_id');
            $table->double('sales_price_final');
            $table->integer('canceled');
            $table->dateTime('canceled_date');
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
        Schema::dropIfExists('sales_process');
    }
}
