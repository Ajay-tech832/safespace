<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->get('authFacebook', 'AuthController@loginUsingFacebook');
$router->get('callbackFacebook', 'AuthController@callbackFromFacebook');

$router->get('registerFacebookUser', 'AuthController@registerFacebookUser');

$router->group(['middleware' => 'auth:api'], function () use ($router) {
    $router->put('user', 'AuthController@userUpdate');
    $router->get('user', 'AuthController@getUser');
    $router->get('hobbies','HobbieController@getHobbies');
    $router->post('user/hobbies','UserController@userHobbiesAdd');
});





$router->get('getinstagramuser', 'AuthController@getInstagramUser');

$router->get('applelogin', 'AppleLoginController@appleLogin');
$router->get('redirect','AppleLoginController@callback');

$router->get('appleuser','AppleLoginController@appleUser');
