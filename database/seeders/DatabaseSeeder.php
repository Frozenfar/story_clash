<?php

namespace Database\Seeders;

use App\Models\Feed;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\User;
use App\Models\TiktokSource;
use App\Models\InstagramSource;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Feed::factory()->count(10)->create()->each(function ($feed) {
            InstagramSource::factory()->create(['feed_id' => $feed->id]);
            TiktokSource::factory()->create(['feed_id' => $feed->id]);
            Post::factory()->count(10)->create(['feed_id' => $feed->id]);
        });
    }
}
