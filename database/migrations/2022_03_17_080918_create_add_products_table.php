<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_products', function (Blueprint $table) {
            $table->id('add_product_id');
            $table->bigInteger('branch_id');
            $table->date('date');
            $table->string('supplier');
            $table->bigInteger('all_product_id');
            $table->double('amount');
            $table->double('body_price_usd');
            $table->double('body_price_uzs');
            $table->bigInteger('user_id');
            $table->integer('invoice_order');
            $table->integer('check_status');
            $table->text('add_comment');
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
        Schema::dropIfExists('add_products');
    }
}
