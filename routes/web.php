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

$router->post('registerFacebookUser', 'AuthController@registerFacebookUser');

$router->post('createMobileOtp', 'AuthController@sendMobileOtp');
$router->post('otpverifywithLogin', 'AuthController@otpverifyWithLogin');

$router->group(['middleware' => 'auth:api'], function () use ($router) {
    $router->put('user', 'AuthController@userUpdate');
    $router->get('user', 'AuthController@getUser');
    $router->get('hobbies','HobbieController@getHobbies');
    $router->get('user/hobbies', 'UserController@getUserHobbies');
    $router->post('user/hobbies','UserController@userHobbiesAdd');
    $router->put('user/hobbies','UserController@userHobbiesUpdate');
    $router->get('user/plans','UserController@getUserPlan');
    $router->post('user/plans','UserController@userPlanAdd');
    $router->post('user/plans-update','UserController@userPlanUpdate');
    $router->get('plans','PlanController@getPlan');
    $router->post('add-plan','PlanController@addPlans');
    $router->post('update-plan','PlanController@updatePlans');
    $router->post('delete-plan','PlanController@deletePlans');
    $router->get('chats','ChatController@getChats');
    $router->get('notifications','NotificationController@getNotifications');
    $router->get('images','ImageController@getImages');
    $router->post('connections','ConnectionController@getConnections');
    $router->post('messages','MessageController@getMessages');
    $router->post('members','MemberController@getMembers');
    $router->post('profile-image','ImageController@storeProfileImages');
    $router->post('profile-imageUpdate','ImageController@updateProfileImages');
    $router->get('questions','QuestionController@getQuestions');
    $router->post('questions','QuestionController@addQuestions');
    $router->get('answers/{id}','AnswerController@getAnswers');
    $router->post('answers','AnswerController@addAnswers');
    $router->post('countries','CountryController@getCountries');
    $router->get('feeds','FeedController@getFeeds');
    $router->post('add-feeds','FeedController@addFeeds');
    $router->post('update-feeds','FeedController@updateFeeds');
    $router->get('feed-details','FeedController@getFeedDetails');
    $router->post('add-feed-details','FeedController@addFeedDetails');
    $router->get('feed-post','FeedController@getFeedPosts');
    $router->post('add-feed-post','FeedController@addFeedPosts');
    $router->post('update-feed-post','FeedController@updateFeedPosts');
    $router->get('feed-post/like','FeedController@getPostLikes');
    $router->post('feed-post/like','FeedController@addPostLikes');
    $router->get('user/friends','UserController@userFriends');
    $router->post('user/friends','UserController@addUserFriends');
    $router->post('user/friends-delete','UserController@removeUserFriends');
    $router->post('latest-message','MessageController@getLoadLatestMessages');
    $router->post('sendOtp','UserController@sendOtp');  
    $router->post('verifyOtp','UserController@verifyOtp');

    $router->get('location','UserController@deviceLocation');
});





$router->get('getinstagramuser', 'AuthController@getInstagramUser');

$router->get('applelogin', 'AppleLoginController@appleLogin');
$router->get('redirect','AppleLoginController@callback');

$router->get('appleuser','AppleLoginController@appleUser');
