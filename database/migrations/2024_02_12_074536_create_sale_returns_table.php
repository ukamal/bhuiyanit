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
        Schema::create('sale_returns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('previous_invoice_id')->nullable();
            $table->string('previous_invoice_no')->nullable();
            $table->string('invoice_no')->nullable();
            $table->string('sale_id')->nullable();
            $table->string('return_date')->nullable();
            $table->string('return_quantity')->nullable();
            $table->string('return_rate')->nullable();
            $table->string('return_amount')->nullable();
            $table->string('total')->nullable();
            $table->string('sales_price')->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('sale_returns');
    }
};
