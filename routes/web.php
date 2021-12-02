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
$router->post('/register', 'AuthController@register');
$router->post('/login', 'AuthController@login');

//Login with facebook

$router->get('auth', 'AuthController@loginUsingFacebook');
$router->get('callback', 'AuthController@callbackFromFacebook');

$router->get('getuser', 'AuthController@getFacebookUser');
$router->post('update', 'AuthController@facebookUserupdate');

//Login with  instagram

// $router->get('authinstagram', 'AuthController@loginUsingInstagram');
// $router->get('callback', 'AuthController@callbackFromInstance');
// $router->get('getinstagramuser', 'AuthController@callbackFromInstance');


$router->get('getinstagramuser', 'AuthController@getInstagramUser');

$router->get('applelogin', 'AppleLoginController@appleLogin');
$router->get('redirect','AppleLoginController@callback');

$router->get('appleuser','AppleLoginController@appleUser');