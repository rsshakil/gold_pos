<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('customer_id')->comment('customer_id');
            $table->string('customer_name', 280)->comment('customer_name')->nullable();
            $table->string('customer_phone', 28)->comment('customer_phone')->nullable();
            $table->string('customer_email', 50)->comment('customer_email')->nullable();
            $table->string('customer_address', 280)->comment('customer_address')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
