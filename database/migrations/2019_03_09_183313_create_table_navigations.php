<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableNavigations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigations', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->string('link_text', 255);
            $table->string('url', 255);
            $table->text('description');
            $table->integer('group_id')->unsigned();
            $table->integer('click_count')->unsigned()->default(0);

            $table->foreign('group_id')->references('id')->on('navigation_groups');

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
        Schema::dropIfExists('navigations');
    }
}
