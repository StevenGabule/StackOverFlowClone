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
       /* factory(App\User::class, 30)->create()->each(function($u) {
            $u->questions()
                ->saveMany(
                    factory(App\Question::class, rand(1,50))->make())
                ->each(function($q) {
                    $q->answers()->saveMany(factory(App\Answer::class, rand(1,10))->make());
            });
        });*/
        $this->call([
            UsersQuestionAnswerTableSeeder::class,
            FavoritesTableSeeder::class,
            VotablesTableSeeder::class,
        ]);
    }
}
