<?php
namespace App\Http\Controllers\Auth;
namespace App\Http\Controllers;
use App\Models\User;
use GeneaLabs\LaravelSocialiter\Facades\Socialiter;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\User as OAuthTwoUser;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AppleLoginController extends Controller
{
    

    public function appleLogin()
    {
        return Socialite::driver("sign-in-with-apple")->redirect();
    }


    public function getAppleUser(Request $request)
    {
        $user = Socialite::driver("sign-in-with-apple")->user();
        dd($user);
       
    }



    public function appleUser(){

        $access_token = $_GET['access_token'];
       $client = new \GuzzleHttp\Client();
   
       $response = $client->request('GET', 'https://appleid.apple.com/auth/token='.$access_token, [
         'headers' => [
           'Accept' => 'application/json',
           'Authorization' => $access_token,
           'Content-Type' => 'application/json',
         ],
       ]);
       $response = json_decode($response->getBody(),true);
       dd($response);
       $instagramUser = User::updateOrCreate([
           'apple_id' => $response['id'],
       ],[
          // 'name' => $response['name'],
           //'password' => Hash::make('123456')
           
            ]);
              
     return response()->json(compact('appleUser'));
   
           }
}
