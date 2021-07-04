<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturnPurchaseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_purchase_details', function (Blueprint $table) {
            $table->increments('return_purchase_detail_id')->comment('return_purchase_detail_id');
            $table->integer('return_purchase_id')->unsigned()->comment('return_purchase_id');
            $table->integer('product_id')->unsigned()->comment('product_id');
            $table->float('unit_price_per_gram', 11,2)->comment('unit_price_per_gram')->nullable();
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
        Schema::dropIfExists('return_purchase_details');
    }
}
