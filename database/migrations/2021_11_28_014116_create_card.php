<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCard extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->integer('health_points');
            $table->boolean('is_first_edition')->default(false);
            $table->boolean('is_taken')->default(false);
            $table->unsignedBigInteger('expansion_set_id');
            $table->unsignedBigInteger('card_rarity_id');
            $table->unsignedDecimal('price');
            $table->string('image_url')->unique();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('expansion_set_id')->references('id')->on('expansion_sets');
            $table->foreign('card_rarity_id')->references('id')->on('card_rarities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card');
    }
}
