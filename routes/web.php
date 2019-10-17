<?php

Auth::routes();
Route::get('/', 'FrontendController@welcome');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile/{user}', 'ProfileController@index')->name('profile');
Route::get('series/{series}', 'FrontendController@series')->name('series');
Route::get('/logout', function() { auth()->logout(); return redirect('/'); });
Route::get('series/', 'FrontendController@showAllSeries')->name('all-series');
Route::get('/register/confirm', 'ConfirmEmailController@index')->name('confirm-email');

Route::middleware('auth')->group(function() {
    Route::post('/card/update','ProfileController@updateCard');
    Route::post('/subscribe', 'SubscriptionController@subscribe');
    Route::post('/subscription/change', 'SubscriptionController@change')->name('subscription.change');
    Route::get('/subscribe', 'SubscriptionController@showSubscriptionForm');
    Route::post('/series/complete-lesson/{lesson}', 'WatchSeriesController@completeLesson');
    Route::get('/watch-series/{series}', 'WatchSeriesController@index')->name('series.learning');
    Route::get('/series/{series}/lesson/{lesson}', 'watchSeriesController@showLesson')->name('series.watch');
});

// Just a hint for Redis methods. Realization is in app/Entities/Learning.php trait
Route::get('/redis', function() {
/*
    Redis has 3 datatypes.
    1. key: value // string. Super simple, one string value
       Redis::set('friend', 'fufu');
       dd(Redis::get('friend'));

    2. key: value // list. An array. Can have duplicate values.
       Redis::lpush('frameworks', ['vue', 'laravel']); create key if not exists in memory, and add values.
       dd(Redis::lrange('frameworks', 0, 5)); // get values by offsets. From 0 to 5
       dd(Redis::lrange('frameworks', 0, -1)); // get values by offsets. From 0 to all

    3. key: value // A Set. No duplicate values. Good for unique values, like ip addresses, or our case
       Redis::sadd('frontend', ['angular', 'ember']);
       dd(Redis::smembers('frontend'));
*/

    Redis::sadd('frontend', ['angular', 'ember']);
    dd(Redis::smembers('frontend'));
});