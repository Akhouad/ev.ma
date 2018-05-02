<?php
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::namespace('Manager')->group(function(){
    Route::prefix('register')->group(function(){
        Route::post('intervenant/{event_id}', 'UserController@register_intervenant')->where('event_id', '[0-9]+');
    });
});

Route::middleware('auth')->group(function(){
    Route::prefix('manager')->namespace('Manager')->group(function(){
        Route::get('settings', 'ManagerController@index')->name('settings');
        Route::get('/', 'ManagerController@index')->name('manager');
        Route::get('/validation', 'ManagerController@validation')->name('validation');

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
    });
});

Route::namespace('Site')->group(function(){
    Route::get('/', 'HomeController@index')->name('homepage');

    Route::prefix('user')->group(function(){
        Route::get('{username}', function(){ return $username; })->name('user')->where('username', '[a-zA-Z-]+');
    });

    Route::prefix('category')->group(function(){
        Route::get('{category}', function(){ return $username; })->name('category')->where('category', '[a-zA-Z-]+');
    });

    Route::prefix('ev/{slug}/{id}')->middleware(App\Http\Middleware\CheckEvent::class)->group(function(){
        Route::get('/', 'EventController@show')->name('event-page')->where('slug', '[a-zA-Z0-9-]+')->where('id', '[0-9]+');
        Route::post('/', 'CommentController@store')->name('event-page')->where('slug', '[a-zA-Z0-9-]+')->where('id', '[0-9]+')->middleware('auth');
        Route::post('attend', 'EventController@attend')->name('attend-event')->where('slug', '[a-zA-Z0-9-]+')->where('id', '[0-9]+')->middleware('auth');
    });

    Route::prefix('cities')->group(function(){
        Route::get('/', 'CityController@index')->name('cities');
        Route::get('{city}', 'CityController@show')->name('city')->where('city', '[a-zA-Z-]+');
    });
});
