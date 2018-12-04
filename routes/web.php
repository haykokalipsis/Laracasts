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





Route::get('/register/confirm', 'ConfirmEmailController@index')->name('confirm-email');

Route::get('{series_by_id}', function (\App\Series $series) {
    dd($series);
});

Route::middleware('admin')->prefix('admin')->group(function (){

});