<?php

use Illuminate\Database\Seeder;

class CoursewareTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        factory(App\Courseware::class, 100)->create();
    }
}
