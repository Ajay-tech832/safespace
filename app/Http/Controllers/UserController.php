<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Models\UserHobbie;
use App\Models\UserPlan;
use App\Transformers\UserPlanTransformer;
use Illuminate\Http\Request;
use App\Http\Requests\userHobbiesAddRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userHobbiesAdd(Request $request)
    {
        try {
            $user= Auth::user();
            $hobbies=$request->hobbies;
            foreach($hobbies as $hobbie)
            {
                UserHobbie::create([
                    'user_id'=>$user->id,
                     'hobbie_id'=>$hobbie,
                ]);
            }
            return response()->json(["message"=>'Successfully Added'],200);
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],  500);
        }    
        
}

    

    public function userHobbiesUpdate(Request $request)
    {
        try {
            $user= Auth::user();
            UserHobbie::where('user_id', $user->id)->delete();
            
            $hobbies=$request->hobbies;
            foreach($hobbies as $hobbie)
            {
                UserHobbie::create([
                    'user_id'=>$user->id,
                    'hobbie_id'=>$hobbie,
                ]);
            }
            return response()->json(["message"=>'Successfully Updated'],200);
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],  500);
        }
    }

    public function getUserPlan()
    {
        try{
            $user_plan = UserPlan::all();
            return fractal()->collection($user_plan)->transformWith(new UserPlanTransformer())->toArray();
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],  500);
        }
       
    }


    public function userPlanAdd(Request $request)
    {
        try{
            $user= Auth::user();
            $user_plan = new UserPlan;
            $user_plan->user_id = $user->id;
            $user_plan->plan_id = $request->input('plan_id');
            $user_plan->start_date = date("Y-m-d",strtotime( $request->input('start_date')));
            $user_plan->end_date = date("Y-m-d",strtotime( $request->input('end_date')));
            $user_plan->transaction_id = $request->input('transaction_id');
            $user_plan->payment_mode = $request->input('payment_mode');
            $user_plan->save();
                
            return response()->json(["message"=>'Plan Successfully Added'],200);
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],  500);
        }
    }

     public function userPlanUpdate(Request $request)
    {
        try{
           $user= Auth::user();
           UserPlan::where('user_id', $user->id)->delete();
           $user_plan = new UserPlan;
           $user_plan->user_id = $user->id;
           $user_plan->plan_id = $request->input('plan_id');
           $user_plan->start_date = date("Y-m-d",strtotime( $request->input('start_date')));
           $user_plan->end_date = date("Y-m-d",strtotime( $request->input('end_date')));
           $user_plan->transaction_id = $request->input('transaction_id');
           $user_plan->payment_mode = $request->input('payment_mode');
           $user_plan->save(); 
            
            return response()->json(["message"=>'Plan Successfully Updated'],200);
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],  500);
        }
    }

}
