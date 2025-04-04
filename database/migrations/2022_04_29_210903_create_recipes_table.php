<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * レシピテーブル
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->integer('type')->nullable()->comment('タイプ');
            $table->string('main_image')->nullable()->comment('メイン画像');
            $table->string('name')->nullable()->comment('レシピ名');
            $table->integer('kcal')->nullable()->comment('カロリー');
            $table->integer('time')->nullable()->comment('所要時間');
            $table->integer('cost')->nullable()->comment('費用');
           
          
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
        Schema::dropIfExists('recipes');
    }
};
