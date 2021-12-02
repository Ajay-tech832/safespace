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
        $saveUser = User::updateOrCreate([
            'facebook_id' => $response['id'],
        ],[
            'full_name' => $response['name'],
            'password' => Hash::make('password'),
            
             ]);
      return response()->json(compact('saveUser'));
    }  


    public function userUpdate(Request $request){

        try{
            if($request->post('id')>0){
                $user= User::find($request->post('id')); 
                $user->email = $request->input('email');
                $user->mobile = $request->input('mobile');
                $user->date_of_birth = date("Y-m-d",strtotime( $request->input('date_of_birth')));
                $user->visible_profile = $request->input('visible_profile');
                $user->orientation = $request->input('orientation');
                $user->relationship_status = $request->input('relationship_status');
                $user->looking_for = $request->input('looking_for');
                $user->pets = $request->input('pets');
                $user->meet_at = $request->input('meet_at');
                $user->religious_views = $request->input('religious_views');
                $user->children = $request->input('children');
                $user->save();
            }
            return response()->json(['user' => $user,'message' =>'Updated'],200);
        } catch (\Exception $e){
          return $e;
            //return response()->json(['message'=>'User Update Fail'],201);
        }
    }


}
