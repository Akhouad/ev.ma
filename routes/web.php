<?php
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::namespace('Manager')->group(function(){
    Route::prefix('register')->group(function(){
        // Route::post('intervenant/{event_id}', 'InterventionController@store')->where('event_id', '[0-9]+');
    });
});

Route::middleware('auth')->group(function(){
    Route::prefix('manager')->middleware(App\Http\Middleware\Manager\CheckManager::class)->namespace('Manager')->group(function(){
        Route::get('settings', 'ManagerController@index')->name('settings');
        Route::get('/', 'ManagerController@index')->name('manager');
        Route::get('/search', 'ManagerController@search')->name('manager-search');
        Route::get('/validation', 'ManagerController@validation')->name('validation');
        Route::get('/validation/search', 'ManagerController@search')->name('validation-search');

        Route::prefix('event')->group(function(){
            Route::get('add', 'EventController@add_index')->name('add-event');
            Route::post('add', 'EventController@store')->name('add-event');
            
            Route::prefix('{id}')->middleware(App\Http\Middleware\Manager\CheckEvent::class)->group(function(){
                Route::get('/', 'EventController@index')->name('event');
                Route::get('edit', 'EventController@edit_index')->name('edit-event');
                Route::post('edit', 'EventController@update')->name('edit-event');
                Route::get('publish', 'EventController@publishEvent')->name('event-publish');
                Route::get('unpublish', 'EventController@unpublishEvent')->name('event-unpublish');
                
                Route::get('intervenants', 'IntervenantController@index')->name('event-intervenants');
                Route::post('intervenants', 'InterventionController@store')->name('event-intervenants');

                Route::get('images', 'ImageController@index')->name('event-images');
                Route::post('images', 'ImageController@store')->name('event-images');
                Route::post('images/delete', 'ImageController@delete')->name('delete-image');

                Route::get('programme', 'ScheduleController@index')->name('event-programme');
                Route::post('programme', 'ScheduleController@create')->name('event-programme');
                Route::get('delete-schedule/{schedule_id}', 'ScheduleController@destroy')->name('delete-schedule')->where('schedule_id', '[0-9]+');
                
                Route::get('comments', 'CommentController@index')->name('event-comments');
                Route::post('comments/delete', 'CommentController@destroy')->name('delete-comments');
                Route::get('attendings', 'AttendingController@index')->name('event-attendings');
                Route::get('attendings/export', 'AttendingController@download')->name('export-attendings');
                Route::get('checkins', 'CheckinController@index')->name('event-checkins');
                Route::get('checkins/export', 'CheckinController@download')->name('export-checkins');

                Route::get('campaigns', 'CampaignController@index')->name('event-campaigns');
                Route::post('campaigns', 'CampaignController@store')->name('event-campaigns');
                Route::get('campaign/{campaign_id}', 'CampaignController@destroy')->name('delete-campaign');

                Route::post('email/{campaign_id}/send', 'EmailController@store')->name('send-email');
            });
        });
        
        // API
        Route::middleware(App\Http\Middleware\Manager\CheckManager::class)->group(function(){
            Route::get('venues/{id}', ['permissions_require_all' => true, 'uses' => 'VenueController@index'])->where('id', '[0-9]+');
            Route::get('users/{user_id}/{contains}', ['permissions_require_all' => true, 'uses' => 'UserController@index'])->where('user_id', '[0-9]+')->where('starts_with', '[a-zA-Z]+');
        
            Route::prefix("intervenants")->group(function(){
                Route::post('/', ['permissions_require_all' => true, 'uses' => 'InterventionController@store'])->where('event_id', '[0-9]+');
            });
    
            Route::prefix('event')->group(function(){
                Route::delete('{event_id}/intervenants/{user_id}/delete', ['permissions_require_all' => true, 'uses' => 'InterventionController@destroy'])->where('event_id', '[0-9]+')->where('user_id', '[0-9]+');
            });
        });
    });
});

Route::namespace('Site')->group(function(){
    Route::get('/', 'HomeController@index')->name('homepage');

    Route::prefix('user')->group(function(){
        Route::get('{username}', function($username){ return $username; })->name('user')->where('username', '[a-zA-Z-]+');
    });

    Route::prefix('settings')->group(function(){
        Route::get('/', 'SettingsController@index')->name('settings');
        Route::post('/', 'SettingsController@store')->name('settings');
        Route::get('password', 'SettingsController@password')->name('password-settings');
        Route::post('password', 'SettingsController@update_password')->name('password-settings');
    });

    Route::prefix('categories')->group(function(){
        Route::get('/', 'CategoryController@index')->name('categories');
        Route::get('{category}', 'CategoryController@show')->name('category')->where('category', '[a-zA-Z-]+');
    });

    Route::prefix('types')->group(function(){
        Route::get('{type}', 'TypeController@show')->name('type')->where('type', '[a-zA-Z-]+');
    });

    Route::prefix('tags')->group(function(){
        Route::get('{tag}', 'TagController@show')->name('tag')->where('tag', '[a-zA-Z-]+');
    });

    Route::prefix('search')->group(function(){
        Route::get('advanced', 'SearchController@index')->name('advanced-search');
    });

    Route::prefix('ev/{slug}/{id}')->middleware(App\Http\Middleware\CheckEvent::class)->group(function(){
        Route::get('/', 'EventController@show')->name('event-page')->where('slug', '[a-zA-Z0-9-]+')->where('id', '[0-9]+');
        Route::post('/', 'CommentController@store')->name('event-page')->where('slug', '[a-zA-Z0-9-]+')->where('id', '[0-9]+')->middleware('auth');
        Route::post('/comment/report', 'CommentController@report')->name('report-comment');
        Route::post('attend', 'EventController@attend')->name('attend-event')->where('slug', '[a-zA-Z0-9-]+')->where('id', '[0-9]+')->middleware('auth');
    });

    Route::get('venue/{slug}', 'VenueController@index')->name('venue')->where('id', '[a-zA-Z-._]+');

    Route::prefix('cities')->group(function(){
        Route::get('/', 'CityController@index')->name('cities');
        Route::get('{city}', 'CityController@show')->name('city')->where('city', '[a-zA-Z-]+');
    });

    // API
    Route::prefix('events')->group(function(){
        Route::get('/', ['permissions_require_all' => true, 'uses' => 'EventController@index']);
        Route::get('{type}', ['permissions_require_all' => true, 'uses' => 'EventController@index'])
                ->where('type', '(coming|now|near)');

        Route::get('latest/{limit}', ['permissions_require_all' => true, 'uses' => 'EventController@latest'])->where('limit', '[0-9]+');
        Route::get('nearest/city/{city}/{limit}', ['permissions_require_all' => true, 'uses' => 'EventController@nearest'])
                ->where('limit', '[0-9]+')->where('city', '[a-zA-z0-9-_.]+');
    });
    
    Route::get('users/city/{city}/{limit}', ['permissions_require_all' => true, 'uses' => 'UserController@index'])
            ->where('city', '[a-zA-Z-]+')->where('limit','[0-9]+');
    Route::prefix('tags')->group(function(){
        Route::get('popular/{limit}', ['permissions_require_all' => true, 'uses' => 'TagController@index'])->where('limit', '[0-9]+');
    });
    Route::prefix('types')->group(function(){
        Route::get('popular/{limit}', ['permissions_require_all' => true, 'uses' => 'TypeController@index'])->where('limit', '[0-9]+');
    });
    Route::prefix('categories')->group(function(){
        Route::get('popular/{limit}', ['permissions_require_all' => true, 'uses' => 'CategoryController@index'])->where('limit', '[0-9]+');
    });
});