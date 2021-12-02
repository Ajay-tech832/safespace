<?php

namespace App\Http\Controllers;
use Laravel\Socialite\Two\FacebookProvider;
use Laravel\Socialite\Facades\Socialite;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use  App\Models\User;
use Laravel\Lumen\Routing\Controller as BaseController;
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;


class AuthController extends FacebookProvider
{
    protected $stateless = true;
    
    public function __construct(Request $request)
    {
        $conf = config('services.facebook');

        parent::__construct(
            $request,
            $conf['client_id'],
            $conf['client_secret'],
            $conf['redirect'],
            []
        );
    }

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


    public function registerFacebookUser(){

        $access_token = $_GET['token'];
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
       
        return response()->json($user,200);
    }  


    public function userUpdate(Request $request){

        try{
            $user= User::find($request->post('id')); 
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
            if(!empty($request->input('about_you'))){
              $user->about_you = $request->input('about_you');
            }
            
            $user->save();
            return response()->json($user,200);
        } catch (\Exception $e){
            return response()->json(['message'=>'User Update Fail'],201);
        }
    }


}
