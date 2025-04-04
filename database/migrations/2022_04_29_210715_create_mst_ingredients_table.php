<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * 材料マスターテーブル
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('type')->comment('種類');//カンマ区切り：1焼き菓子
            $table->string('name')->comment('材料名');
            $table->string('unit')->comment('単位');//g ml
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
        Schema::dropIfExists('mst_ingredients');
    }
};
