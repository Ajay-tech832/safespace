<?php

namespace App\Models;
use App\Models\FeedPostImage;
use Illuminate\Database\Eloquent\Model;

class FeedPost extends Model
{
    public function feedPostImages()
    {
         return $this->hasMany(FeedPostImage::class,'feed_post_id');
    }
}
