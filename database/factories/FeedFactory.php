<?php

namespace Database\Factories;

use App\Models\Feed;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Feed>
 */
class FeedFactory extends Factory
{
    protected $model = Feed::class;

    public function definition()
    {
        static $id = 120; // so i added this since in the example the test command was with id 123
        return [
            'id'=>$id++,
            'name' => $this->faker->name,
        ];
    }
}
