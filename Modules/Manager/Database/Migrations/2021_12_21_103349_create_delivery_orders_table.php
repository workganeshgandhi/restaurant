<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_orders', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->string('name');
            $table->string('mobile');
            $table->string('address');
            $table->float('deliveryFees');
            $table->unsignedInteger('branch_id')->nullable();
            $table->unsignedInteger('cashier_id')->nullable();
            $table->unsignedInteger('delivery_boy_id')->nullable();
            $table->unsignedInteger('offer_id')->nullable();
            $table->float('total_price');
            $table->enum('status', ['accepted', 'declined'])->nullable();
            $table->timestamps();
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->foreign('cashier_id')->references('id')->on('cashiers')->onDelete('cascade');
            $table->foreign('delivery_boy_id')->references('id')->on('delivery_boys')->onDelete('cascade');
            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('delivery_orders');
    }
}
