<?php

namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite;
use GuzzleHttp\Client;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\facebookUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Transformers\UserTransformer;
use App\Transformers\UserProfileTransformer;


class AuthController extends Controller
{
    protected $stateless = true;
    

    //Login with Facebook


    public function loginUsingFacebook()
    {
        return Socialite::driver('facebook')->stateless()->redirect();
    }

    public function callbackFromFacebook()
    {
        $user=Socialite::driver('facebook')->stateless()->user();
        echo $user->token;
    
    }


    public function registerFacebookUser(facebookUserRequest $request)
    {
      try{
            $access_token = $request->token;
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', 'https://graph.facebook.com/me?access_token='.$access_token, [
              'headers' => [
                  'Accept' => 'application/json',
                  'Authorization' => $access_token,
                  'Content-Type' => 'application/json',
              ],
            ]);
            $response = json_decode($response->getBody(),true);

            $user = User::where('facebook_id' , $response['id'])->first();
            if(empty($user)){
                $profile = $client->request('GET', 'https://graph.facebook.com/'.$response['id'].'?fields=id,first_name,last_name,name,email&access_token='.$access_token, [
                      'headers' => [
                          'Accept' => 'application/json',
                          'Authorization' => $access_token,
                          'Content-Type' => 'application/json',
                      ],
                    ]);
                    $profile = json_decode($profile->getBody(),true);
                    $data = array(
                                    "full_name"=>$profile['name'],
                                    "first_name"=>$profile['first_name'],
                                    "last_name"=>$profile['last_name'],
                                    "email"=>$profile['email'],
                                    "password"=>Hash::make('password'),
                                    "facebook_id"=>$profile['id'],
                    );
                    $user = User::create($data);
            }
            $token = Auth::login($user);
            return response()->json(['token'=>$token,'user'=>$user],200);
       }catch (Exception $e) {
        return response()->json(['message' => $e->getMessage()],  500);
       } 
        
    }  

    public function getUser()
    {
      try{
          $user = User::with('profileImage','members')->where('id', Auth::id())->get();
          return fractal()->collection($user)->transformWith(new UserProfileTransformer())->toArray();
        }catch (Exception $e) {
          return response()->json(['message' => $e->getMessage]);
        }
          
    }

    // public function getUser(){
    //     try{
    //         $user= Auth::user(); 
    //         return fractal()->item($user)->transformWith(new UserProfileTransformer())->toArray();
    //         //return response()->json($user,200);
    //     } catch (Exception $e){
    //         return response()->json(['message'=>'Some thing went wrong'],201);
    //     }
    // }


    public function userUpdate(Request $request){

       try{
            $user= Auth::user();  
            if(!empty($request->input('email'))){
                $user->email = $request->input('email');
            }
            if(!empty($request->input('mobile'))){
              $user->mobile = $request->input('mobile');
            }
            if(!empty($request->input('date_of_birth'))){
              $user->date_of_birth = date("Y-m-d",strtotime( $request->input('date_of_birth')));
            }
            if(!empty($request->input('visible_profile'))){
              $user->visible_profile = $request->input('visible_profile');
            }
            if(!empty($request->input('orientation'))){
              $user->orientation = $request->input('orientation');
            }
            if(!empty($request->input('relationship_status'))){
              $user->relationship_status = $request->input('relationship_status');
            }
            if(!empty($request->input('looking_for'))){
              $user->looking_for = $request->input('looking_for');
            }
            if(!empty($request->input('pets'))){
              $user->pets = $request->input('pets');
            }
            if(!empty($request->input('meet_at'))){
              $user->meet_at = $request->input('meet_at');
            }
            if(!empty($request->input('religious_views'))){
              $user->religious_views = $request->input('religious_views');
            }
            if(!empty($request->input('children'))){
              $user->children = $request->input('children');
            }
            if(!empty($request->input('is_smoke'))){
              $user->is_smoke = $request->input('is_smoke');
            }
            if(!empty($request->input('is_drink'))){
              $user->is_drink = $request->input('is_drink');
            }
            if(!empty($request->input('is_canabis'))){
              $user->is_canabis = $request->input('is_canabis');
            }
            if(!empty($request->input('about'))){
              $user->about = $request->input('about');
            }
            
            $user->save();

            return response()->json($user,200);
        } catch (Exception $e){
            return response()->json(['message'=>'User Update Fail'],201);
        }
    }

    public function sendMobileOtp(Request $request)
    {
        try{
          $otp = rand(100000, 999999);
          $user = new User;
          $user->mobile = $request->input('mobile');
          $user->otp = $otp;
          $user->save();
          $response['message'] = 'Your OTP is created.';
          $response['OTP'] = $otp;

          return response()->json(['message' => $response]);
        }catch (Exception $e){
          return response()->json(['message' => $e->getMessage()]);
        }
          
    }

    public function otpverifyWithLogin(Request $request)
    {
        try{
          $user = User::where('mobile', $request->input('mobile'))->firstOrFail();
          if($user->otp == $request->otp)
          {
            if(!$token = Auth::fromUser($user))
            {
              return response()->json(['message' =>'Unauthorized'],401);
            }
            }else{
             return response()->json(['message' =>'Invalid OTP'],401);
            }
            User::where('mobile',$request->input('mobile'))->update(['isVerified' => 1]);
 
            return response()->json(['token'=>$token,'user'=>$user],200);
        }catch (Exception $e){
          return response()->json(['message' => $e->getMessage()]);
        }
    }

   
}
