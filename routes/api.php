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
$router->group([
    'prefix' => 'api/v1', 'middleware' => ['cors', 'log','lang']], function () use ($router) {


    $router->group([
        'prefix'    => '/indicators',
        'namespace' => 'Component'], function () use ($router) {

        $router->get('/', ['uses' => 'IndicatorController@index']);



    });
});

