<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGramToVoriUpdadeTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP TRIGGER IF EXISTS product_gram_to_vori_after_update');
        DB::unprepared('CREATE TRIGGER product_gram_to_vori_after_update BEFORE UPDATE ON `products` FOR EACH ROW
        BEGIN
            IF NEW.vori is null THEN
                 SET NEW.vori = (select vori from products WHERE products.product_id = NEW.product_id);
            ELSE
                SET NEW.vori = (NEW.weight/11.664);
            END IF;
        END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `product_gram_to_vori_after_update`');
    }
}
