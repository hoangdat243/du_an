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
        $this->call(UserSeeder::class);
    }
}
class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
                DB::table('users')->insert([
                    ['name'=>'user1','email'=>'dat@gmail.com','password'=>bcrypt(123456)],
                ]);
    }
}
