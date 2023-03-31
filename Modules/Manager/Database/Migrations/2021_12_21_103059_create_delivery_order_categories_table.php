<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryOrderCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_order_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('delivery_order_id');
            $table->unsignedInteger('category_id');
            $table->enum('category_type', ['spicy', 'classic'])->default('classic');
            $table->integer('mount');
            $table->float('subtotal');
            $table->timestamps();
            $table->foreign('delivery_order_id')->references('id')->on('deliver_orders')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('delivery_order_categories');
    }
}
