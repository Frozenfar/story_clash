<?php

namespace App\Models;

use App\Models\Feed;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['feed_id', 'url'];

    public function feed()
    {
        return $this->belongsTo(Feed::class);
    }
}
