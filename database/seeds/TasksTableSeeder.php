<?php

use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
         DB::table('tasks')->insert([
             'created_at' => Carbon\Carbon::now()->toDateTimeString(),
             'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
             'title' => 'Doctors Appointment',
             'priority' => '4',
              'user_id' => 2,
              'group_id' => 1,
              'complete' => 0
         ]);

         DB::table('tasks')->insert([
             'created_at' => Carbon\Carbon::now()->toDateTimeString(),
             'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
             'title' => 'Christmas Party',
             'priority' => '2',
             'user_id' => 1,
             'group_id' => 2,
             'complete' => 0
         ]);

         DB::table('tasks')->insert([
             'created_at' => Carbon\Carbon::now()->toDateTimeString(),
             'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
             'title' => 'Book Club',
             'priority' => '5',
              'user_id' => 2,
              'group_id' => 3,
              'complete' => 0

         ]);
     }
   }
