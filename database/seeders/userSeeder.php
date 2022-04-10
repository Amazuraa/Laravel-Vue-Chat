<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pict = [
            'https://cdn.pixabay.com/photo/2014/03/29/09/17/cat-300572__340.jpg',
            'https://cdn.pixabay.com/photo/2017/10/27/21/51/tiger-2895617__340.jpg',
            'https://cdn.pixabay.com/photo/2016/11/13/21/46/sheep-1822137__340.jpg'
        ];

        DB::table('users')->insert([
            [
                'name' => "User X",
                'email' => "userx@gmail.com",
                'chats' => "[]",
                'picture' => $pict[0],
                'password' => bcrypt('laravue_chat'),
                'created_at' => new \DateTime,
            ],
            [
                'name' => "User Y",
                'email' => "usery@gmail.com",
                'chats' => "[]",
                'picture' => $pict[1],
                'password' => bcrypt('laravue_chat'),
                'created_at' => new \DateTime,
            ],
            [
                'name' => "User Z",
                'email' => "userz@gmail.com",
                'chats' => "[]",
                'picture' => $pict[2],
                'password' => bcrypt('laravue_chat'),
                'created_at' => new \DateTime,
            ]
        ]);
    }
}
