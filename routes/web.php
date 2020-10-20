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

$router->group(['prefix' => 'api/v1', 'namespace' => 'Api\v1'], function () use ($router) {

    // Add CPF - Adiciona um CPF na lista restrita (US01)
    $router->post('cpf', ['as' => 'cpf.create', 'uses' => 'CpfRestrictListController@store']);
    
    // Find All CPFs - Retorna a lista de CPF's da lista restrita (US04)
    $router->get('cpf', ['as' => 'cpf.index', 'uses' => 'CpfRestrictListController@index']);

    // Check CPF - Verifica se um CPF está adicionado na lista restrita (US02)
    $router->get('cpf/{cpf}', ['as' => 'cpf.show', 'uses' => 'CpfRestrictListController@show']);
});
