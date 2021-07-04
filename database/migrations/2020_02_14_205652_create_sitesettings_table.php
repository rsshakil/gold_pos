<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitesettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sitesettings', function (Blueprint $table) {
            $table->increments('setting_id')->comment('setting_id');
            $table->integer('vat_tax')->default('5')->comment('vat_tax');
            $table->integer('making_cos_per_gram')->default('400')->comment('making_cos_per_gram');
            $table->integer('ruturn_decrease_percent')->default('10')->comment('ruturn_decrease_percent');
            $table->integer('purchase_decrease_percent')->default('20')->comment('purchase_decrease_percent');
            $table->string('company_logo', 280)->comment('company_logo')->nullable();
			$table->string('company_name', 280)->comment('company_name')->nullable();
			$table->string('currency', 280)->default('৳')->comment('currency');
			$table->float('platinam_21_carat_price', 11,2)->comment('platinam_21_carat_price')->nullable();
			$table->float('platinam_22_carat_price', 11,2)->comment('platinam_22_carat_price')->nullable();
			$table->float('diamond_21_carat_price', 11,2)->comment('diamond_21_carat_price')->nullable();
			$table->float('diamond_22_carat_price', 11,2)->comment('diamond_22_carat_price')->nullable();
			$table->float('gold_21_carat_price', 11,2)->comment('gold_21_carat_price')->nullable();
			$table->float('gold_22_carat_price',11,2)->comment('gold_22_carat_price')->nullable();
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
        Schema::dropIfExists('sitesettings');
    }
}
