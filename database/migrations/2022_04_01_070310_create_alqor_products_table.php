<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlqorProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alqor_products', function (Blueprint $table) {
            $table->id('alqor_product_id');
            $table->bigInteger('product_id');
            $table->double('product_amount');
            $table->double('body_price_usd');
            $table->double('body_price_uzs');
            $table->double('selling_price');
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
        Schema::dropIfExists('alqor_products');
    }
}
