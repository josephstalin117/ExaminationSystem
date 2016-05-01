<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePapersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('papers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->default('0');
            $table->string('name');
            $table->integer('score');
            $table->integer('time')->default('60');
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
        Schema::drop('papers');
    }
}
