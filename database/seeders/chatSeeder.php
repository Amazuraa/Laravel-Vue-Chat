<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class chatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chats = array(
            [
                'user' => '1',
                'data' => 'Hiii!',
                'date' => '2022-03-26',
            ],
            [
                'user' => '2',
                'data' => 'Lorem Ipsum!',
                'date' => '2022-03-26',
            ]
        );

        DB::table('chats')->insert([
            'data_chat' => json_encode($chats),
            'status' => 1,
        ]);
    }
}
