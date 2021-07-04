<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaledetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saledetails', function (Blueprint $table) {
            $table->increments('saledetail_id')->comment('saledetail_id');
            $table->integer('sale_id')->unsigned()->comment('sale_id');
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
        Schema::dropIfExists('saledetails');
    }
}
