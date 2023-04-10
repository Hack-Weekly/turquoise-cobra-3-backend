<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('posts')->delete();
        
        \DB::table('posts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'title' => 'Pariatur Voluptatem',
                'content' => '<p>Sit, suscipit fuga. .</p>',
                'slug' => 'pariatur-voluptatem',
                'meta_data' => '[{"attribute":"Sit at esse doloru","value":"Sit at esse doloru"}]',
                'is_published' => false,
                'created_at' => '2023-04-10 08:44:19',
                'updated_at' => '2023-04-10 08:44:19',
                'hero_url' => 'http://localhost/storage/blog-hero-images/5ab41bd1a7a272f8511b9c55908eacf21681116259.webp',
            ),
            1 => 
            array (
                'id' => 4,
                'user_id' => 1,
                'title' => 'Qui ipsum quia quos',
                'content' => '<p>Mollit ut eius sint .</p><img src="http://localhost/storage/blog-images/b49f2e6131adfe82622c5e42e004a4531681117239.webp">',
                'slug' => 'qui-ipsum-quia-quos',
                'meta_data' => 'null',
                'is_published' => false,
                'created_at' => '2023-04-10 09:06:14',
                'updated_at' => '2023-04-10 09:06:14',
                'hero_url' => 'http://localhost/storage/blog-hero-images/8a2f216287b02ccf76f8f65249e459371681117574.webp',
            ),
        ));
        
        
    }
}