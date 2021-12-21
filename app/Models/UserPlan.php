<?php

namespace App\Models;
use App\Models\Plan;
use Illuminate\Database\Eloquent\Model;

class UserPlan extends Model
{
    protected $fillable = [

        'user_id','plan_id',

    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
