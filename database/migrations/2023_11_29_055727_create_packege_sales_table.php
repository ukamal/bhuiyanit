<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackegeSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packege_sales', function (Blueprint $table) {
            $table->id();
            $table->date('sale_date');
            $table->string('invoice_no');
            $table->string('customer_id');
            $table->string('brand_name');
            $table->string('model');
            $table->string('chasis_no');
            $table->string('customer_mobile');
            $table->string('packege_id');
            $table->string('service_name');
            $table->string('service_value');
            $table->string('quantity');
            $table->dateTime('service_datetime')->nullable();
            $table->decimal('paid_amount', 10, 2);
            $table->decimal('due_amount', 10, 2);
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
        Schema::dropIfExists('packege_sales');
    }
}
