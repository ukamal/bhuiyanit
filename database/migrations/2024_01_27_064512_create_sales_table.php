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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->date('sale_date');
            $table->string('sale_no');
            $table->integer('customer_id');
            $table->string('brand_name')->nullable();
            $table->string('model')->nullable();
            $table->string('customer_address')->nullable();
            $table->string('customer_mobile')->nullable();
            $table->decimal('grandTotal', 8, 2)->default(0.00);
            $table->decimal('paid_amount', 8, 2)->nullable();
            $table->decimal('due_amount', 8, 2)->nullable();
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
        Schema::dropIfExists('sales');
    }
};
