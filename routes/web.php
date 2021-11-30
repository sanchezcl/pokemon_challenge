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

$router->get('/', 'InfoController@info');
$router->get('/is_alive', 'InfoController@isAlive');

$router->get('/card_rarities', 'CardRarityController@index');
$router->get('/expansion_set', 'ExpansionSetController@index');
$router->get('/pokemon_type', 'PokemonTypeController@index');

$router->group(['prefix' => 'cards'], function () use ($router){
    $router->get('/', ['as' => 'card.index', 'uses' => 'CardController@index']);
    $router->post('/', ['as' => 'card.store', 'uses' => 'CardController@store']);
    $router->get('/{id}', ['as' => 'card.show', 'uses' => 'CardController@show']);
    $router->put('/{id}', ['as' => 'card.update', 'uses' => 'CardController@update']);
    $router->delete('/{id}', ['as' => 'card.delete', 'uses' => 'CardController@destroy']);

    $router->patch('/{id}/take', ['as' => 'take_card', 'uses' => 'CardManagerController@takeCard']);
    $router->patch('/{id}/return', ['as' => 'return_card', 'uses' => 'CardManagerController@returnCard']);
    $router->patch('/return_all', ['as' => 'return_all', 'uses' => 'CardManagerController@returnAllCards']);
});
