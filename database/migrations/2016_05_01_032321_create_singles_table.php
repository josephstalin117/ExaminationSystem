<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSinglesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('singles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->default('0');
            $table->string('title');
            $table->integer('score');
            $table->string('a');
            $table->string('b');
            $table->string('c');
            $table->string('d');
            $table->string('answer');
            $table->string('remark');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('singles');
    }
}
