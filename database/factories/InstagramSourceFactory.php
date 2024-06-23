<?php

namespace Database\Factories;

use App\Models\Feed;
use App\Models\InstagramSource;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InstagramSource>
 */
class InstagramSourceFactory extends Factory
{
    protected $model = InstagramSource::class;

    public function definition()
    {
        return [
            'feed_id' => Feed::factory(),
            'name' => $this->faker->userName,
            'fan_count' => $this->faker->numberBetween(100, 1000),
        ];
    }
}
