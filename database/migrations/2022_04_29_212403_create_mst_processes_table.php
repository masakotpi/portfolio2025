<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * 工程マスターテーブル
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_processes', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('process');
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
        Schema::dropIfExists('mst_processes');
    }
};
