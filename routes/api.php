<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::namespace("Manager")->group(function(){
    Route::get('venues/{id}', ['permissions_require_all' => true, 'uses' => 'ApiController@getVenues'])->where('id', '[0-9]+');
    Route::get('users/{user_id}/{contains}', ['permissions_require_all' => true, 'uses' => 'ApiController@getUsers'])
            ->where('user_id', '[0-9]+')->where('starts_with', '[a-zA-Z]+');

    Route::prefix("intervenants")->group(function(){
        Route::get('{event_id}/get', ['permissions_require_all' => true, 'uses' => 'ApiController@getIntervenants'])->where('event_id', '[0-9]+');
        Route::post('{event_id}/add', ['permissions_require_all' => true, 'uses' => 'ApiController@addIntervenant'])->where('event_id', '[0-9]+');
        Route::delete('{event_id}/delete/{user_id}', ['permissions_require_all' => true, 'uses' => 'ApiController@deleteIntervenant'])->where('event_id', '[0-9]+')->where('user_id', '[0-9]+');
    });
});
