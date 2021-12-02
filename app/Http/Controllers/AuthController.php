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
            if($request->post('id')>0){
                $user= User::find($request->post('id'));    
                $user->email = $request->input('email');
                $user->dob = $request->input('dob');
                $user->save();
            }
            return response()->json($user,200);
        } catch (\Exception $e){
            return response()->json(['message'=>'User Update Fail'],201);
        }
    }


}
