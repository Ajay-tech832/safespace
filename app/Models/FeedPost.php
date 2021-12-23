<?php

namespace App\Models;
use Illuminate\support\Facades\Auth;
use App\Models\FeedPostImage;
use App\Models\Like;
use Illuminate\Database\Eloquent\Model;

class FeedPost extends Model
{
    public function feedPostImages()
    {
         return $this->hasMany(FeedPostImage::class,'feed_post_id');
    }

    public function feedPostlikes()
    {
        return $this->hasMany(Like::class);
    }
    
    public function likedBy()
    {
        return $this->belongsToMany(User::class,'likes','feed_post_id','user_id');
    }
    
    public function getIsLikedAttribute()
    {
        return $this->feedPostlikes->where('user_id',Auth::id())->count()>0;
    }
}
