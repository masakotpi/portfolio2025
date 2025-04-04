<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * 使用材料テーブル
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->integer('recipe_id')->comment('レシピID');
            $table->integer('mst_ingredient_id')->comment('材料マスターID');
            $table->integer('type')->nullable()->comment('材料分類');//A,B,C
            $table->string('name')->nullable()->comment('材料名');
            $table->integer('amount')->nullable()->comment('分量');
            $table->integer('unit')->nullable()->comment('単位');
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
        Schema::dropIfExists('ingredients');
    }
};
