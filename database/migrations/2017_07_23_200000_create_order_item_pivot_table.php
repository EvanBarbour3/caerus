<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * None conventional Laravel naming convention. item_order sounds less right than order_item.
 *
 * Class CreateOrderItemPivotTable
 *
 * @author EB
 */
class CreateOrderItemPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_item', function (Blueprint $table) {
            $table->integer('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('items');
            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_item', function (Blueprint $table) {
            $table->dropForeign(['item_id']);
            $table->dropForeign(['order_id']);
        });

        Schema::dropIfExists('order_item');
    }
}
