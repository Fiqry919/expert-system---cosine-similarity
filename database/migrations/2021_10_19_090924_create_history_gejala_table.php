<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryGejalaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_gejala', function (Blueprint $table) {
            $table->id();
            $table->string('history_id');
            $table->string('gejala');
            $table->timestamps();
        });

        Schema::table('history_gejala', function (Blueprint $table) {
            $table->foreign('history_id')->references('id')->on('history')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_gejala');
    }
}
