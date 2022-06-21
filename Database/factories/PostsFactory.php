<?php

namespace Modules\Blog\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Blog\Entities\Posts::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'post_title'    =>  $this->faker->realText(rand(20,50)),
            'post_content'  =>  $this->faker->realText(rand(500,1000)),
            'post_content_short'    =>  $this->faker->realText(rand(100,150)),
            'post_category_id'      =>  rand(1,5),
            'post_image'            =>  false,
            'post_status'           =>  rand(0,1),
            'post_created_at'       =>  now(),
            'post_author'           =>  '1',
        ];
    }
}

