<?php

namespace Modules\Blog\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Blog\Entities\Post;
use Modules\Blog\Entities\PostLinks;
use Modules\Library\Entities\Book;

class BlogDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Book::factory(400)->create();

        Post::factory(150)->create();



        foreach (Post::all() as $post) {

            for ($i=0; $i < rand(1,9); $i++)
            {
                PostLinks::factory()->create([
                    'post_id'   =>  $post->id,
                ]);
            }

        }
    }
}
