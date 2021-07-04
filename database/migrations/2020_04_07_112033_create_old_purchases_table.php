<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOldPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('old_purchases', function (Blueprint $table) {
            $table->increments('old_purchase_id')->comment('old_purchase_id');
            $table->integer('outlet_id')->unsigned()->comment('wholesale_purchase_id');
            $table->integer('customer_id')->unsigned()->comment('outlet_id');
            $table->integer('sale_id')->unsigned()->comment('sale_id');
            $table->integer('payment_type_id')->unsigned()->comment('payment_type_id');
            $table->string('voucher_number', 280)->comment('product_name')->nullable();
            $table->integer('total_item')->default('1')->comment('total_item');
			$table->float('total_weight', 11,3)->comment('total_weight')->nullable();
			$table->float('purchase_amount', 11,2)->comment('vori')->nullable();
			$table->float('discount_amount', 11,2)->comment('vori')->nullable();
			$table->float('return_decrease_amount', 11,2)->comment('vori')->nullable();
			$table->float('paid_amount', 11,2)->comment('vori')->nullable();
            $table->float('due_amount', 11,2)->comment('vori')->nullable();
            $table->float('taxable_amount', 11,2)->comment('vori')->nullable();
			$table->float('item_price', 11,2)->comment('vori')->nullable();
			$table->float('estimate_total_amount', 11,2)->comment('vori')->nullable();
			$table->float('vori', 11,3)->comment('vori')->nullable();
			$table->integer('unit_price')->comment('price')->nullable();
			$table->date('purchase_date')->comment('sale_date')->nullable();
			$table->date('estimate_due_payment_date')->comment('estimate_due_payment_date')->nullable();
			$table->date('due_given_payment_date')->comment('due_given_payment_date')->nullable();
			$table->dateTime('purchase_datetime')->comment('sale_datetime')->nullable();
            $table->enum('purchase_status', ['0', '1'])->default('1')->comment('1 saled 0 ordered data');
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
        Schema::dropIfExists('old_purchases');
    }
}
