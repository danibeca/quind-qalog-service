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
    'prefix' => 'api/v1', 'middleware' => ['cors', 'log', 'lang']], function () use ($router) {

    $router->group([
        'prefix'    => '/components',
        'namespace' => 'Component'], function () use ($router) {

        $router->get('/{id:[\d]+}/docker', ['uses' => 'DockerComposeController@index']);

    });

    $router->group([
        'middleware' => ['auth']], function () use ($router) {

        $router->group([
            'prefix'    => '/components',
            'namespace' => 'Component'], function () use ($router) {

            $router->get('/', ['uses' => 'ComponentController@index']);
            $router->post('/', ['uses' => 'ComponentController@store']);
            $router->put('/{id:[\d]+}', ['uses' => 'ComponentController@update']);
            $router->delete('/{id:[\d]+}', ['uses' => 'ComponentController@destroy']);

            $router->get('/{id:[\d]+}/leaves', ['uses' => 'ComponentLeafController@index']);

            $router->post('/{id:[\d]+}/metric-values', ['uses' => 'ComponentMetricValueController@create']);
            $router->post('/{id:[\d]+}/issue-values', ['uses' => 'ComponentIssueValueController@create']);

            $router->get('/{id:[\d]+}/quality-system-instances', ['uses' => 'ComponentQualitySystemController@index']);

            $router->get('/{id:[\d]+}/docker', ['uses' => 'DockerComposeController@index']);

        });

        $router->group([
            'prefix'    => '/indicators',
            'namespace' => 'Component'], function () use ($router) {

            $router->get('/', ['uses' => 'IndicatorController@index']);

        });

        $router->group([
            'prefix'    => '/metrics',
            'namespace' => 'Metric'], function () use ($router) {

            $router->get('/', ['uses' => 'ExternalMetricController@index']);
        });

        $router->group([
            'prefix'    => '/quality-systems',
            'namespace' => 'QualitySystem'], function () use ($router) {
            $router->get('/', ['uses' => 'QualitySystemController@index']);
        });

        $router->group([
            'prefix'    => '/quality-system-instances',
            'namespace' => 'QualitySystem'], function () use ($router) {
            $router->get('/', ['uses' => 'QualitySystemInstanceController@index']);
            $router->get('/{id:[\d]+}', ['uses' => 'QualitySystemInstanceController@show']);
            $router->get('/verify', ['uses' => 'QualitySystemInstanceController@verify']);
            $router->post('/', ['uses' => 'QualitySystemInstanceController@store']);
            $router->put('/{id:[\d]+}', ['uses' => 'QualitySystemInstanceController@update']);
        });

        $router->group([
            'prefix'    => '/api-clients',
            'namespace' => 'APIClient'], function () use ($router) {
            $router->get('/{code}/roots', ['uses' => 'APIClientComponentController@index']);
            $router->post('/{id:[\d]+}/roots', ['uses' => 'APIClientComponentController@update']);
            $router->get('/{code}', ['uses' => 'APIClientController@show']);
            $router->post('/{code}/resources', ['uses' => 'APIClientResourceController@store']);
        });
    });
});


