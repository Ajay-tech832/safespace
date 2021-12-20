<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Http\Requests\PlanRequest;
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

    public function addPlans(PlanRequest $request)
    {
        try{
            $plan = new Plan;
            $plan->name = $request->input('name');
            $plan->duration_amount = $request->input('duration_amount');
            $plan->duration_type = $request->input('duration_type');
            $plan->price = $request->input('price');
            $plan->description = $request->input('description');
            $plan->save();
           
            return response()->json(['message'=>'Plan Added Succssfully']);
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],  500); 
        }
    }

    public function updatePlans(PlanRequest $request)
    {
        try{
            $plan =  Plan::find($request->post('id'));
            $plan->name = $request->input('name');
            $plan->duration_amount = $request->input('duration_amount');
            $plan->duration_type = $request->input('duration_type');
            $plan->price = $request->input('price');
            $plan->description = $request->input('description');
            $plan->save();

            return response()->json(['message'=>'Plan Updated Succssfully']);
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],  500);
        }
        
    }

    public function deletePlans(Request $request)
    {
        try{
            $plan = Plan::find($request->post('id'));
            $plan->delete();
    
            return response()->json(['message' =>'Plan Deleted Successfully']);
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],  500);
        }
        
    }
}
