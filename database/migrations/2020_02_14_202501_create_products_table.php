<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('product_id')->comment('product_id');
            $table->integer('wholesale_purchase_id')->unsigned()->comment('wholesale_purchase_id');
            $table->integer('product_categorie_id')->unsigned()->comment('product_categorie_id');
            $table->integer('product_sub_categorie_id')->unsigned()->comment('product_sub_categorie_id');
            $table->integer('outlet_id')->default('0')->comment('outlet_id');
            $table->string('barcode', 280)->comment('product_name')->nullable();
            $table->enum('product_carat_type', ['20','21', '22'])->default('21')->comment('21 carat');
			$table->string('product_name', 280)->comment('product_name')->nullable();
			$table->string('product_image', 280)->comment('product_name')->nullable();
			$table->text('product_desc')->comment('product_desc')->nullable();
			$table->float('weight', 11,3)->comment('weight')->nullable();
			$table->float('vori', 11,3)->comment('vori')->nullable();
			$table->integer('price')->comment('price')->nullable();
			$table->dateTime('product_datetime')->comment('product_datetime')->nullable();
            $table->enum('stock', ['0', '1'])->default('1')->comment('1 instock');
            $table->enum('ready_made', ['0', '1'])->default('0')->comment('0 readymade');
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
        Schema::dropIfExists('products');
    }
}
