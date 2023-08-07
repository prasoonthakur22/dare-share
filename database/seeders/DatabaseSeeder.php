<?php

namespace Database\Seeders;

use App\Models\Choice;
use App\Models\Dare;
use App\Models\Quizze;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call([
            // RolePermissionSeeder::class,
            // AdminSeeder::class,
            // DareSeeder::class,
            // QuizzeSeeder::class
        ]);
        $dares = Dare::factory(5)->create();

        $dares->each(function ($dare) {
            $quizzes = Quizze::factory(15)->create(
                [
                    'dare_id' =>  $dare->id
                ]
            );
            $quizzes->each(function ($quizze) {
                Choice::factory(4)->create(
                    [
                        'quizze_id' =>  $quizze->id
                    ]
                );
            });
        });
    }
}
