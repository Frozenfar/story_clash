<?php

namespace App\Models;

use App\Models\Post;
use App\Models\TiktokSource;
use App\Models\InstagramSource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feed extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function instagramSources()
    {
        return $this->hasOne(InstagramSource::class);
    }

    public function tiktokSource()
    {
        return $this->hasOne(TiktokSource::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
