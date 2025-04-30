<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('product_id');
            $table->string('silver_rate')->nullable();
            $table->string('silver_qty')->nullable();
            $table->string('bronze_rate')->nullable();
            $table->string('bronze_qty')->nullable();
            $table->string('ss_rate')->nullable();
            $table->string('ss_qty')->nullable();
            $table->string('other_rate')->nullable();
            $table->string('other_qty')->nullable();
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
        Schema::dropIfExists('order_products');
    }
}
