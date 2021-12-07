<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Transformers\PlanTransformer;
class PlanController extends Controller
{
   
    public function getPlan(){
        $plans = Plan::all();
        foreach($plans as $plan){

        }
        return fractal()->item($plan)->transformWith(new PlanTransformer())->toArray();

    }

}
