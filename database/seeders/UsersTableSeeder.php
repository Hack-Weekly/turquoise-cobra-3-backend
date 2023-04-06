<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Preston Workman',
                'email' => 'qygono@mailinator.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$MePwxb1PteV6wYq6MxZd0eDW7D/n1zxnBOh5M8YY.dyDbHkpbv4xu',
                'remember_token' => 'RvaGVO8WKbcRFSo7RVzRssDQDYLLwW6bbkiImI26tat5GZEvxBlaHeBmuI1e',
                'created_at' => '2023-04-05 12:11:29',
                'updated_at' => '2023-04-05 12:11:29',
            ),
        ));
        
        
    }
}