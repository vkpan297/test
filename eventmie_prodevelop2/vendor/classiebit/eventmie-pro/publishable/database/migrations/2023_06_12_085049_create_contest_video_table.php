<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContestVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contest_video', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('contest_id')->nullable();
			$table->integer('customer_id')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('link_video')->nullable();
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
        Schema::dropIfExists('contest_video');
    }
}
