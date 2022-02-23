<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfferAllegro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('a_offer_allegro', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_user');
            $table->string('id_offer');
            $table->datetime('created_at');
            $table->datetime('updated_at');

            $table->index('id_offer');
            $table->index('id_user');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('a_offer_allegro');
    }
}
