<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_no');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->foreignId('supplier_id')->constrained()->cascadeOnDelete();
            $table->date('order_date');
            $table->longText('customer_address')->nullable();
            $table->longText('supplier_address')->nullable();
            $table->string('customer_mobile')->nullable();
            $table->string('supplier_mobile')->nullable();
            $table->string('grandTotal')->nullable();
            $table->string('supplier_comm')->nullable();
            $table->string('supplier_com_percent')->nullable();
            $table->string('supplier_advenced')->nullable();
            $table->string('customer_comm')->nullable();
            $table->string('customer_com_percent')->nullable();
            $table->string('customer_advence')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
