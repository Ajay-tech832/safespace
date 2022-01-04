<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Models\UserHobbie;
use App\Models\UserPlan;
use App\Models\Connection;
use App\Transformers\UserPlanTransformer;
use App\Transformers\UserTransformer;
use App\Transformers\HobbiesTransformer;
use App\Transformers\UserHobbieTransformer;
use Illuminate\Http\Request;
use App\Http\Requests\userHobbiesAddRequest;
use App\Models\User;
use App\MSG91;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getUserHobbies()
    {
       $user_hobbies = UserHobbie::with('hobbie')->where('user_id', Auth::id())->get();
       return fractal()->collection($user_hobbies)->transformWith(new UserHobbieTransformer())->toArray();
    }
     
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
            $user_plan = UserPlan::with('plan')->get();
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

    public function userFriends()
    {
       try {
        $friends = Auth::user()->friends()->get();
        return fractal()->collection($friends)->transformWith(new UserTransformer())->toArray();
       }catch (Exception $e){
           return response()->json(['message' => $e->getMessage()],  500);
       }
    }

    public function addUserFriends(Request $request)
    {
        try{
            $user_friends = $request->user_friends;
            foreach($user_friends as $user_friend){

                Auth::user()->friends()->attach($user_friend); 
            }
            
           return response()->json(["message"=>'User Friends Added Successfully']);
        }catch (Exception $e) {
           return response()->json(['message' => $e->getMessage()],  500);
        }
    }

    public function removeUserFriends(Request $request)
    {
        try {
             Auth::user()->friends()->detach([3]);

             return response()->json(["message"=>'User Friend Removed Successfully']);
        }catch (Exception $e){
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }


    public function sendOtp(Request $request)
    {

      try {
        $response = array();
        $userId = Auth::user()->id;

        $users = User::where('id', $userId)->first();
        if(isset($users['mobile']) && $users['mobile'] == ""){
            return response()->json(['message' => 'Invalid mobile number']);
        }else{
             $otp = rand(100000, 999999);
             $MSG91 = new MSG91();

            $msg91Response = $MSG91->sendSMS($otp,$users['mobile']);
            $response['message'] = 'Your OTP is created.';
            $response['OTP'] = $otp;

            $users->otp = $otp;
            $users->save();
            
            }
            return response()->json(['message' => $response]);
      }catch (Exception $e) {
          return response()->json(['message' => $e->getMessage()],  500);
      }
       
    }

    public function verifyOtp(Request $request)
    {
       try{
        $response = array();
        $enteredOtp = $request->input('otp');
        $userId = Auth::user()->id;

        if($userId == "" || $userId== null){
           $response['message'] = 'You are logged out, Login again.';    
        }else{
            $users = User::where('id', $userId)->first();
            $OTP = $users->otp;
            if($OTP === $enteredOtp){

                User::where('id',$userId)->update(['isVerified' => 1]);

                $response['isVerified'] = 1;
                $response['message'] = "Your Number is Verified.";
            }else{
                $response['isVerified'] = 0;
                $response['message'] = "OTP does not match.";
            }
        }
        return response()->json(['message' =>$response]);
       }catch (Exception $e) {
           return response()->json(['message' => $e->getMessage()],  500);
       }
        
    }

}
