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
       	foreach (App\User::all() as $user) {
       		$user->tasks()->createMany(
       			factory(App\Task::class, 3)->raw()
       		);
       	}
    }
}
