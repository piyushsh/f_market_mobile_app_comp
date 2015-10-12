<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class UserIdeaTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        /*
         * Tables to hold constant values which will be used in other tables
         */

        Schema::create('idea_status_codes',function(Blueprint $table){
            $table->increments('status_id')->unsigned();
            $table->string('status');
        });


        /*
         * User registering for the competition
         */
        Schema::create('user',function(Blueprint $table){
            $table->increments("user_id")->unsigned();
            $table->string('name');
            $table->string('email');
            $table->string('country');
            $table->string('contact_no');
        });

        /*
         * Idea Table
         */
        Schema::create('idea',function(Blueprint $table){
            $table->increments('idea_id')->unsigned();

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('user_id')->on('user')->onDelete('cascade');

            $table->string("idea_title");
            $table->integer('total_team_members');
            $table->boolean('startup_experience')->default(0);
            $table->text('about_startup_experience')->nullable();
            $table->text('about_app_idea');
            $table->text('additional_information')->nullable();
            $table->text('app_designs_link')->nullable();

            //Used by admin to approve/disaprove idea
            $table->integer('status')->unsigned()->nullable();
            $table->foreign('status')->references('status_id')->on('idea_status_codes')->onDelete('SET NULL');
        });

        /*
         * Team table
         */
        Schema::create('team',function(Blueprint $table){
            $table->increments("id");
            $table->integer('idea_id')->unsigned();
            $table->foreign('idea_id')->references('idea_id')->on('idea')->onDelete('cascade');

            $table->string('team_member_email');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('team',function(Blueprint $table){
            $table->dropForeign('team_idea_id_foreign');
        });
        Schema::drop('team');

        Schema::table('idea',function(Blueprint $table){
            $table->dropForeign('idea_status_foreign');
            $table->dropForeign('idea_user_id_foreign');
        });
        Schema::drop('idea');

        Schema::drop('user');

        Schema::drop('idea_status_codes');
    }
}
