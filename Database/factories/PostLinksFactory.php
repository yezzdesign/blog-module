<?php

namespace Modules\Blog\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostLinksFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Blog\Entities\PostLinks::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'post_id'   =>   rand(1,150),
            'link_name' =>  $this->faker->word,
            'link_address'  =>  'https://www.'.$this->faker->word.'.de',
            'link_icon' =>  null,
        ];
    }
}

