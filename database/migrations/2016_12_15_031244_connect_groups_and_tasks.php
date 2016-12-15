<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConnectGroupsAndTasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         //
         Schema::table('tasks', function (Blueprint $table) {

             # Add a new INT field called `group_id` that has to be unsigned (i.e. positive)
             $table->integer('group_id')->unsigned();
             # This field `group_id` is a foreign key that connects to the `id` field in the `groups` table
             $table->foreign('group_id')->references('id')->on('groups');
         });
     }
     public function down()
     {
         Schema::table('tasks', function (Blueprint $table) {
             # ref: http://laravel.com/docs/migrations#dropping-indexes
             # combine tablename + fk field name + the word "foreign"
             $table->dropForeign('tasks_group_id_foreign');
             $table->dropColumn('group_id');
         });
     }
}
