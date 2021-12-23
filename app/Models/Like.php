<?php

namespace App\Models;
use App\Models\FeedPost;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'user_id','feed_post_id',
    ];

    public function feedPosts()
    {
        return $this->belongsTo(FeedPost::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
