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
            
            Route::prefix('{id}')->group(function(){
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
            });
        });
    });
});
