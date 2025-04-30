<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQoutationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qoutations', function (Blueprint $table) {
            $table->id();
            $table->string('qoutation_no');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->date('sale_date')->nullable();
            $table->longText('customer_address')->nullable();
            $table->string('customer_mobile')->nullable();
            $table->longText('subject')->nullable();
            $table->longText('dsc')->nullable();
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
        Schema::dropIfExists('qoutations');
    }
}
