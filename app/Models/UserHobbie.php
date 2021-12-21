<?php

namespace App\Models;
use App\Models\Hobbie;
use Illuminate\Database\Eloquent\Model;

class UserHobbie extends Model
{
    protected $fillable = [

        'user_id','hobbie_id',

    ];

    public function hobbie()
    {
      return $this->belongsTo(Hobbie::class);  
    }

}
