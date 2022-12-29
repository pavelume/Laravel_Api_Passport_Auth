<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['name'=>'Pavel','email'=>'pavel@gmail.com','password'=>'123456'],
            ['name'=>'igen','email'=>'igen@gmail.com','password'=>'123456'],
     
        ];
        User::insert($users);
    }
}
