<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedDetail extends Model
{
    protected $fillable = [
        'heading','sub_heading','about','goal'
    ];
}
