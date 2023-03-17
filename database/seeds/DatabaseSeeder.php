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
        // $this->call(UsersTableSeeder::class);
        //factory(App\model\Subject::class, 10)->create();
        //factory(App\model\classes::class, 3)->create();
        factory(App\model\Student::class, 20)->create();
        //factory(App\model\studentoptionalsubject::class, 20)->create();

    }
}
