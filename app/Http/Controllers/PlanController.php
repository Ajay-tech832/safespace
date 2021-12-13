<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Transformers\PlanTransformer;
class PlanController extends Controller
{
   
    public function getPlan(){
        try{
            $plans = Plan::all();
        
            return fractal()->collection($plans)->transformWith(new PlanTransformer)->toArray();
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],  500);

        }

    }
}
