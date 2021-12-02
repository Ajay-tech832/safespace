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
        //dd($_GET);
        $user=Socialite::driver('facebook')->stateless()->user();
       var_dump($_REQUEST);
        dd($user);
     try {
         
          $user = Socialite::driver('facebook')->user();
          $token = $user->token;
         // $secret_code=$_GET['code'];
          $saveUser = User::updateOrCreate([
              'facebook_id' => $user->getId(),
          ],[
              'name' => $user->getName(),
              'email' => $user->getEmail(),
              'password' => Hash::make('123456')
               ]);
   
        return response()->json(compact('saveUser'));

          } catch (\Throwable $th) {
             throw $th;
          }
      }


    public function getFacebookUser()
    {

    $access_token = $_GET['code'];

    $client = new \GuzzleHttp\Client();

    $response = $client->request('GET', 'https://graph.facebook.com/me?access_token='.$access_token, [
      'headers' => [
        'Accept' => 'application/json',
        'Authorization' => $access_token,
        'Content-Type' => 'application/json',
      ],
    ]);
    //return json_decode($response->getBody(),true);
    $response = json_decode($response->getBody(),true);
    dd($response);
    $saveUser = User::updateOrCreate([
        'facebook_id' => $response['id'],
    ],[
        'name' => $response['name'],
        'password' => Hash::make('123456')
        
         ]);

  return response()->json(compact('saveUser'));



    }  


 public function facebookUserupdate(Request $request)
 {

    // $this->validate($request, [
    //             'email' => 'required|email|unique:users',
    //             'dob' => 'required|string',
    //         ]);
            try{
            if($request->post('id')>0){
            $user= User::find($request->post('id'));    
            $user->email = $request->input('email');
            $user->dob = $request->input('dob');
            $user->save();
            }    
            
        
            return response()->json(['user' => $user,'message' =>'Updated'],200);
           } catch (\Exception $e){
            return response()->json(['message'=>'User Update Fail'],201);
           }

 }





  
      //Login with Instagram

  
    public function getInstagramUser(){

     $access_token = $_GET['access_token'];

    $client = new \GuzzleHttp\Client();

    $response = $client->request('GET', 'https://graph.instagram.com/me?access_token='.$access_token, [
      'headers' => [
        'Accept' => 'application/json',
        'Authorization' => $access_token,
        'Content-Type' => 'application/json',
      ],
    ]);
    $response = json_decode($response->getBody(),true);
    
    $instagramUser = User::updateOrCreate([
        'instagram_id' => $response['id'],
    ],[
       // 'name' => $response['name'],
        'password' => Hash::make('123456')
        
         ]);
           
  return response()->json(compact('instagramUser'));

        }
  
  











//    public function register(Request $request)
//    {
//     $this->validate($request, [
//         'name' => 'required|string',
//         'email' => 'required|email|unique:users',
//         'password' => 'required|confirmed',
//     ]);
//     try{
//     $user= new User;
//     $user->name = $request->input('name');
//     $user->email = $request->input('email');
//     $plainPassword = $request->input('password');
//     $user->password = app('hash')->make($plainPassword);
//     $user->save();

//     return response()->json(['user' => $user,'message' =>'CREATED'],200);
//    } catch (\Exception $e){
//     return response()->json(['message'=>'User Registration Fail'],201);
//    }
//  }

//  public function login(Request $request)
//     {
//           //validate incoming request 
//         $this->validate($request, [
//             'email' => 'required|string',
//             'password' => 'required|string',
//         ]);

//         $credentials = $request->only(['email', 'password']);

//         if (! $token = Auth::attempt($credentials)) {
//             return response()->json(['message' => 'Unauthorized'], 401);
//         }

//         return response()->json(compact('token'));
//     }






    // public function buildAuthUrl(): string
    // {
    //     $state = null;

    //     if ($this->usesState()) {
    //         $this->request->session()->put('state', $state = $this->getState());
    //     }

    //     return $this->getAuthUrl($state);
    // }

    // public function getUser(string $code): ?User
    // {
    //     if ($this->user) {
    //         return $this->user;
    //     }

    //     $response = $this->getAccessTokenResponse($code);

    //     $this->user = $this->mapUserToObject($this->getUserByToken(
    //         $token = Arr::get($response, 'access_token')
    //     ));

    //     return $this->user->setToken($token)
    //         ->setRefreshToken(Arr::get($response, 'refresh_token'))
    //         ->setExpiresIn(Arr::get($response, 'expires_in'));
    // }



    // public function loginUsingInstagram()
    // {
    //   //return Socialite::driver('instagram')->stateless()->redirect();
    //   $appId = config('services.instagram.client_id');
    //   $redirectUri = urlencode(config('services.instagram.redirect'));
    //   return redirect()->to("https://api.instagram.com/oauth/authorize?app_id={$appId}&redirect_uri={$redirectUri}&scope=user_profile,user_media&response_type=code");
    // }

    // public function callbackFromInstance(Request $request)
    // {
    //   $code = $request->code;
    //   if (empty($code)) return "Please provide code.";
  
    //   $appId = config('services.instagram.client_id');
    //   $secret = config('services.instagram.client_secret');
    //   $redirectUri = config('services.instagram.redirect');
  
    //   $client = new Client();
  
    //   // Get access token
    //   $response = $client->request('POST', 'https://api.instagram.com/oauth/access_token', [
    //       'form_params' => [
    //           'app_id' => $appId,
    //           'app_secret' => $secret,
    //           'grant_type' => 'authorization_code',
    //           'redirect_uri' => $redirectUri,
    //           'code' => $code,
    //       ]
    //   ]);
  
    //   if ($response->getStatusCode() != 200) {
    //       return "Unauthorized login to Instagram.";
    //   }
  
    //   $content = $response->getBody()->getContents();
    //   $content = json_decode($content);
  
    //   $accessToken = $content->access_token;
    //   $userId = $content->user_id;
  
    //   // Get user info
    //   $response = $client->request('GET', "https://graph.instagram.com/me?fields=id,username,account_type&access_token={$accessToken}");
  
    //   $content = $response->getBody()->getContents();
    //   $oAuth = json_decode($content);
  
      
    //   $username = $oAuth->username;
  
      
    //   }



}
