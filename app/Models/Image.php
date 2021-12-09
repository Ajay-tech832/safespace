<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
       'path','type','name',   

    ];

    protected $hidden = [
        'is_active','is_delete','created_by','updated_by','deleted_by','user_id','date_time','updated_at','created_at'
    ];
}
