<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredient_menus', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();

            $table->unsignedBigInteger('id_menu');
            $table->unsignedBigInteger('id_ingredient');

            $table->integer('quantity');

            // $table->foreign('id_menu')->references('id')->on('menus');
            // $table->foreign('id_ingredient')->references('id')->on('ingredients');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredient_menus');
    }
}
