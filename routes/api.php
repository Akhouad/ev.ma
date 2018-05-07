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
// Route::namespace("Manager")->group(function(){
//     Route::get('venues/{id}', ['permissions_require_all' => true, 'uses' => 'VenueController@index'])->where('id', '[0-9]+');
//     Route::get('users/{user_id}/{contains}', ['permissions_require_all' => true, 'uses' => 'UserController@index'])->where('user_id', '[0-9]+')->where('starts_with', '[a-zA-Z]+');

//     Route::prefix("intervenants")->group(function(){
//         Route::get('{event_id}/get', ['permissions_require_all' => true, 'uses' => 'IntervenantController@index'])->where('event_id', '[0-9]+');
//         Route::post('{event_id}/add', ['permissions_require_all' => true, 'uses' => 'IntervenantController@store'])->where('event_id', '[0-9]+');
//         Route::delete('{event_id}/delete/{user_id}', ['permissions_require_all' => true, 'uses' => 'IntervenantController@destroy'])->where('event_id', '[0-9]+')->where('user_id', '[0-9]+');
//     });
// });

// Route::namespace("Site")->group(function(){
//     Route::get('events', ['permissions_require_all' => true, 'uses' => 'ApiController@events']);
//     Route::get('users/city/{city}/{limit}', ['permissions_require_all' => true, 'uses' => 'ApiController@usersByCity'])
//             ->where('city', '[a-zA-Z-]+')->where('limit','[0-9]+');
// });

// Route::middleware(App\Http\Middleware\Manager\CheckManager::class)->get("users", function() { return "dfdf"; });
// Route::middleware(App\Http\Middleware\Manager\CheckManager::class)->get("users", 'Manager\UserController@get');
