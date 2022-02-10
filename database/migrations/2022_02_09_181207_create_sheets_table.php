<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sheets', function (Blueprint $table) {
            $table->id();
            $table->morphs('sheetable');
            $table->dateTime('date');
            $table->dateTime('register_1');
            $table->dateTime('register_2')->nullable();
            $table->dateTime('register_3')->nullable();
            $table->dateTime('register_4')->nullable();
            $table->dateTime('register_5')->nullable();
            $table->dateTime('register_6')->nullable();
            $table->dateTime('register_7')->nullable();
            $table->dateTime('register_8')->nullable();
            $table->time('sum')->nullable();
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
        Schema::dropIfExists('sheets');
    }
}
