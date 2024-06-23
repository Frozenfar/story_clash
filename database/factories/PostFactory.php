<?php

namespace Database\Factories;

use App\Models\Feed;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'feed_id' => Feed::factory(),
            'url' => $this->faker->url,
        ];
    }
}
