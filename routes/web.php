<?php

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
$router->post('login','AuthController@login');

$router->group(['middleware' => 'auth:api'], function($router)
{
    $router->get('users','UsersController@index');

    $router->get('check-token','AuthController@check_token');
    $router->post('logout','AuthController@logout');
});

$router->post('users','UsersController@store');

// $router->get('/key', function() {
//     return str_random(32);
// });
