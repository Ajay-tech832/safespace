<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Transformers\PlanTransformer;
class PlanController extends Controller
{
   
    public function getPlan(){
        $plans = Plan::all();
        
        return fractal()->collection($plans)->transformWith(new PlanTransformer)->toArray();

    }

}
