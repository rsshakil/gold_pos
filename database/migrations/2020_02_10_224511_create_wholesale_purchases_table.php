<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWholesalePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wholesale_purchases', function (Blueprint $table) {
            $table->increments('wholesale_purchase_id')->comment('wholesale_purchase_id');
            $table->integer('admin_purchase_categeorie_id')->unsigned()->comment('admin_purchase_categeorie_id');
            $table->integer('vendor_id')->unsigned()->comment('vendor_id');
			$table->string('item_name', 280)->comment('product_sub_cat_name')->nullable();
			$table->float('weight', 11,3)->comment('weight')->nullable();
			$table->float('vori', 11,3)->comment('vori')->nullable();
			$table->integer('price')->comment('price')->nullable();
			$table->integer('paid_amount')->comment('paid_amount')->nullable();
			$table->integer('due_amount')->comment('due_amount')->nullable();
			$table->date('estimate_due_payment_date')->comment('purchase_datetime')->nullable();
			$table->date('due_given_payment_date')->comment('purchase_datetime')->nullable();
			$table->dateTime('purchase_datetime')->comment('purchase_datetime')->nullable();
            $table->enum('delete_status', ['0', '1'])->default('0')->comment('status');
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
        Schema::dropIfExists('wholesale_purchases');
    }
}
