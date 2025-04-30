<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_sales', function (Blueprint $table) {
            $table->id();
            $table->date('invoice_date');
            $table->double('service_sale_no');
            $table->unsignedBigInteger('customer_id');
            $table->string('brand_name');
            $table->string('model');
            $table->string('chasis_no');
            $table->string('mobile');
            $table->text('item_dsc');
            $table->string('unit');
            $table->string('rate');
            $table->string('total');
            $table->string('grand_total');
            $table->text('dsc');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
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
        Schema::dropIfExists('service_sales');
    }
}
