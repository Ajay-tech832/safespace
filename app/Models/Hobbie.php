<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hobbie extends Model
{
    protected $hidden = [
        'updated_at','created_at'
    ];
}
