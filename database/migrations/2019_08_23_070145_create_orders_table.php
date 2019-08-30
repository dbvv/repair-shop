<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->integer('client_id');
            $table->integer('brand_id');
            $table->integer('type_id');
            $table->text('model_data');
            $table->integer('workshop_id');
            $table->integer('price')->nullable();
            $table->integer('client_pay')->nullable();
            $table->text('notices')->nullable();
            $table->text('problem');
            $table->text('imei')->nullable();
            $table->boolean('completed')->default(false);
            $table->softDeletes();
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
