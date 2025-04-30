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
        Schema::create('item_qoutations', function (Blueprint $table) {
            $table->id();
            $table->date('qoutation_date')->nullable();
            $table->string('qoutation_no')->nullable();
            $table->string('customer')->nullable();
            $table->string('customer_address')->nullable();
            $table->string('customer_mobile')->nullable();
            $table->text('sub')->nullable();
            $table->decimal('grandTotal', 10, 2)->nullable();
            $table->decimal('discount_percentage', 10, 2)->nullable();
            $table->decimal('paid_amount', 10, 2)->nullable();
            $table->decimal('due_amount', 10, 2)->nullable();
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
        Schema::dropIfExists('item_qoutations');
    }
};
