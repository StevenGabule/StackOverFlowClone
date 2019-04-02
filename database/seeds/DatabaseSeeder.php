<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         //$this->call(UsersTableSeeder::class);
        factory(App\User::class, 50)->create()->each(function($u) {
            $u->questions()->saveMany(factory(App\Question::class, rand(1,100))->make());
        });
    }
}