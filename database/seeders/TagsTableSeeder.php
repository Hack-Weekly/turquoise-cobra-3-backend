<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tags')->delete();
        
        \DB::table('tags')->insert(array (
            0 => 
            array (
                'id' => 2,
                'tag' => 'Laravel',
                'created_at' => '2023-04-07 07:53:45',
                'updated_at' => '2023-04-07 07:53:45',
            ),
            1 => 
            array (
                'id' => 3,
                'tag' => 'React JS',
                'created_at' => '2023-04-07 07:53:51',
                'updated_at' => '2023-04-07 07:53:51',
            ),
            2 => 
            array (
                'id' => 4,
                'tag' => 'Node JS',
                'created_at' => '2023-04-07 07:53:54',
                'updated_at' => '2023-04-07 07:53:54',
            ),
            3 => 
            array (
                'id' => 5,
                'tag' => 'Vue JS',
                'created_at' => '2023-04-07 07:53:58',
                'updated_at' => '2023-04-07 07:53:58',
            ),
        ));
        
        
    }
}