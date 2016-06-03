<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['as' => 'home', "uses" => 'CommonController@index']);


Route::group(['middleware' => 'auth'], function () {

    Route::get('/scores', ["as" => "scores", "uses" => 'ScoreController@index']);
    Route::get('/pay', ["as" => "pay", "uses" => 'PayController@index']);
    Route::get('/record/food', ["as" => "record_food", "uses" => 'PayController@recordFood']);
    Route::get('/record/bowling', ["as" => "record_bowling", "uses" => 'PayController@recordBowling']);

});

// Route::group(['prefix' => 'api/v1', 'middleware' => 'auth:api'], function () {
Route::group(['prefix' => 'api/v1'], function () {
    Route::post('/ledger/record', ["as" => "ledger_record", "uses" => 'PayApiController@record']);
    Route::post('/score/record', ["as" => "record_score", "uses" => 'ScoreController@record']);

});

Route::get('logout', 'Auth\AuthController@logout');