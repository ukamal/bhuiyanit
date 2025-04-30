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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('sale_id')->nullable();
            $table->date('invoice_date')->nullable();
            $table->string('invoice_no')->nullable();
            $table->string('type')->nullable();
            $table->decimal('supplier_comm', 8, 2)->nullable();
            $table->decimal('supplier_com_percent', 5, 2)->nullable();
            $table->decimal('supplier_advenced', 10, 2)->nullable();
            $table->decimal('customer_comm', 8, 2)->nullable();
            $table->decimal('customer_com_percent', 5, 2)->nullable();
            $table->decimal('customer_advence', 10, 2)->nullable();
            $table->decimal('grandTotal', 10, 2)->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->integer('transaction_id')->nullable();
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
        Schema::dropIfExists('invoices');
    }
};
