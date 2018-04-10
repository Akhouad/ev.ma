<?php
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::namespace('Manager')->group(function(){
    Route::prefix('register')->group(function(){
        Route::post('intervenant/{event_id}', 'UserController@register_intervenant')->where('event_id', '[0-9]+');
    });
});

Route::middleware('auth')->group(function(){
    Route::get('settings', 'ManagerController@index')->name('settings');

    Route::prefix('manager')->namespace('Manager')->group(function(){
        Route::get('/', 'ManagerController@index')->name('manager');
        Route::get('/validation', 'ManagerController@validation')->name('validation');

        Route::prefix('e')->group(function(){
            Route::get('add', 'EventController@addView')->name('add-event');
            Route::post('add', 'EventController@addEvent')->name('add-event');
            
            Route::prefix('{id}')->group(function(){
                Route::get('/', 'EventController@eventView')->name('event');
                Route::get('edit', 'EventController@editEvent')->name('edit-event');
                Route::post('edit', 'EventController@editEventPost')->name('edit-event');
                Route::get('intervenants', 'EventController@intervenantsView')->name('event-intervenants');
                Route::get('publish', 'EventController@publishEvent')->name('event-publish');
                Route::get('unpublish', 'EventController@unpublishEvent')->name('event-unpublish');
            });
        });
    });
});
