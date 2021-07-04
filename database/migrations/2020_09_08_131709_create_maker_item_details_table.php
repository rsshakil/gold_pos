<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMakerItemDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maker_item_details', function (Blueprint $table) {
            $table->increments('maker_item_detail_id')->comment('maker_item_detail_id');
            $table->integer('maker_item_id')->unsigned()->comment('maker_item_id');
            $table->integer('quantity')->unsigned()->comment('quantity');
            $table->string('item_name',300)->comment('item_name');
            $table->string('sample_img',300)->comment('sample_img');
            $table->float('given_weight', 11,3)->comment('given_weight')->nullable();
            $table->float('return_weight', 11,3)->comment('return_weight')->nullable();
            $table->enum('item_type', ['21', '22'])->default('21')->comment('22 carat');
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
        Schema::dropIfExists('maker_item_details');
    }
}
