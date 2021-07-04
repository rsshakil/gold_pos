<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOutletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outlets', function (Blueprint $table) {
            $table->increments('outlet_id')->comment('outlet_id');
			$table->string('outlet_name', 280)->comment('outlet_name')->nullable();
            $table->string('outlet_email', 80)->comment('outlet_email')->nullable();
            $table->string('outlet_phone', 20)->comment('Phone Number')->nullable();
            $table->string('postal_code', 40)->comment('postal_code')->nullable();
            $table->string('address', 340)->comment('address')->nullable();
            $table->text('outlet_desc')->comment('outlet_desc')->nullable();
            $table->string('outlet_opentime',255)->comment('outlet_opentime')->nullable();
            $table->string('outlet_closetime',255)->comment('outlet_closetime')->nullable();
            $table->string('weekend_day', 80)->comment('weekend_day')->nullable();
            $table->string('image', 240)->comment('Image of outlet')->nullable();
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
        Schema::dropIfExists('outlets');
    }
}
