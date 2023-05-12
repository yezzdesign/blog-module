<?php

namespace Modules\Blog\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Library\Entities\Book;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Blog\Entities\Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'author_id' =>  rand(1,10),
            'book_id'   =>  rand(1, Book::all()->count()),
            'title'     =>  $this->faker->realTextBetween(50, 100),
            'content'   =>  $this->faker->realTextBetween(1500, 3500),
            'content_short' =>  $this->faker->realTextBetween(200, 250),
            'is_launched'   =>  rand(0,1),
            //'launch_date'   =>  $this->faker->dateTimeBetween('-2 years'),
            'launch_date'   =>  (rand(0,1)) ? $this->faker->dateTimeBetween('-2 years') : null,
            //'cover_image_path'  =>  null,
            //'categories'        =>  null,

        ];
    }
}

