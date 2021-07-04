<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGramToVoriInsertTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS product_gram_to_vori_after_insert');
        DB::unprepared('CREATE TRIGGER product_gram_to_vori_after_insert BEFORE INSERT ON `products` FOR EACH ROW SET NEW.vori = (NEW.weight/11.664)');
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `product_gram_to_vori_after_insert`');
    }
}
