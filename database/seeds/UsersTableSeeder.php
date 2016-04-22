<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*DB::table('users')->insert([
            'name' => str_random(10),
            'email' => str_random(10).'@100tal.com',
            'password' => bcrypt('secret'),
            'authority' => random_int(0,4),
        ]);*/



        $user=factory(App\User::class)->make([
            'name' => 'zheng1',
            'email' => 'zheng1@100tal.com',
            'password' => bcrypt(123),
            'authority' => 0,
        ]);
        $user->save();
        $user=factory(App\User::class)->make([
            'name' => 'zheng2',
            'email' => 'zheng2@100tal.com',
            'password' => bcrypt(123),
            'authority' => 1,
        ]);
        $user->save();
        $user=factory(App\User::class)->make([
            'name' => 'zheng3',
            'email' => 'zheng3@100tal.com',
            'password' => bcrypt(123),
            'authority' => 2,
        ]);
        $user->save();
        $user=factory(App\User::class)->make([
            'name' => 'zheng4',
            'email' => 'zheng4@100tal.com',
            'password' => bcrypt(123),
            'authority' => 3,
        ]);
        $user->save();
        $user=factory(App\User::class)->make([
            'name' => 'zheng5',
            'email' => 'zheng5@100tal.com',
            'password' => bcrypt(123),
            'authority' => 4,
        ]);
        $user->save();
        /*factory(\App\User::class,50)->create()->each(function ($u) {
            $u->coursewares()->save(factory(\App\Courseware::class)->make());
            $u->elements()->save(factory(\App\Element::class)->make());
        });*/

    }
}
