<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMakerItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maker_items', function (Blueprint $table) {
            $table->increments('maker_item_id')->comment('sale_id');
            $table->integer('maker_id')->unsigned()->comment('maker_id');
            $table->integer('wholesale_purchase_id')->unsigned()->comment('wholesale_purchase_id');
			$table->date('making_start_date')->comment('making_start_date')->nullable();
			$table->date('making_end_date')->comment('making_end_date')->nullable();
            $table->date('delivery_date')->comment('delivery_date')->nullable();
            $table->enum('delivery_status', ['0', '1'])->default('0')->comment('1 delivered');
            $table->enum('delete_status', ['0', '1'])->default('0')->comment('1 deleted');
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Time of creation');
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->comment('Time of Update');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maker_items');
    }
}
