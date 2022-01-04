<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'author_ID' => $this->faker->numberBetween(1, 2),
            'category_ID' => $this->faker->numberBetween(1, 5),
            'post_content' => $this->faker->paragraphs(5, true),
            'post_short_content' => $this->faker->paragraphs(1, true),
            'post_title' => $this->faker->words(6,true),
            'post_slug' => function (array $attributes) {
                $title=$attributes['post_title'];
                $slug= str_replace(" ","-",strtolower($title));
                return str_replace(".","",$slug);
            },
            // 'post_type' => $this->faker->shuffle(['post','page'])[1],
            'post_type' => $this->faker->numberBetween(1, 3),
            'post_thumbnail' => "posts/def_thumbnail.png"
        ];
    }
}
