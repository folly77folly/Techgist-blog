<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdColumnToBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blogs', function (Blueprint $table) {
            //
            $table->bigInteger('user_id')->unsigned()->nullable();
        });

        Schema::table('blogs', function ($table) {
            //
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
            //
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');
            $table->dropForeign('user_id');
            $table->dropIfExists('user_id');
        });
    }
}
