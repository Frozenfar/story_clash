<?php

namespace Database\Factories;

use App\Models\Feed;
use App\Models\TiktokSource;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TiktokSource>
 */
class TiktokSourceFactory extends Factory
{
    protected $model = TiktokSource::class;

    public function definition()
    {
        return [
            'feed_id' => Feed::factory(),
            'name' => $this->faker->userName,
            'fan_count' => $this->faker->numberBetween(1000, 1000000),
        ];
    }
}
