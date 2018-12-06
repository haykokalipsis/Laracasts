<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
Route::get('/logout', function () {
    auth()->logout();
});

Route::get('/', 'FrontendController@welcome');

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

Route::get('series/{series}', 'FrontendController@series')->name('series');
Route::get('/register/confirm', 'ConfirmEmailController@index')->name('confirm-email');

Route::get('{series_by_id}', function (\App\Series $series) {
    dd($series);
});

Route::middleware('admin')->prefix('admin')->group(function (){

});