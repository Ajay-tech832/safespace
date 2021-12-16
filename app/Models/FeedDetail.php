<?php

namespace App\Models;
use App\Models\FeedDetailImage;
use Illuminate\Database\Eloquent\Model;

class FeedDetail extends Model
{
    protected $fillable = [
        'heading','sub_heading','about','goal'
    ];

    public function feedDetailImages()
     {
       return  $this->hasMany(FeedDetailImage::class,'feed_detail_id');
     }
}
