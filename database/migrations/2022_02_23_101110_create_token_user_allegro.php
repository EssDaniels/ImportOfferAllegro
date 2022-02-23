<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTokenUserAllegro extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('a_token_user_allegro', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user');
            $table->longText('access_token');
            $table->longText('refresh_token');
            $table->datetime('created_at');
            $table->datetime('updated_at');

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
        Schema::dropIfExists('a_token_user_allegro');
    }
}
