<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Models\UserHobbie;
use App\Models\UserPlan;
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


    public function userPlanAdd(Request $request)
    {
        try{
            $user= Auth::user();
            $plans=$request->plans;
            foreach($plans as $plan)
            {
                UserPlan::create([
                  'user_id'=>$user->id,
                  'plan_id' =>$plan,
                ]);
            }
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
            
            $plans=$request->plans;
            foreach($plans as $plan)
            {
                UserPlan::create([
                  'user_id'=>$user->id,
                  'plan_id' =>$plan,
                ]);
            }
            return response()->json(["message"=>'Plan Successfully Updated'],200);
        }catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()],  500);
        }
    }

}
