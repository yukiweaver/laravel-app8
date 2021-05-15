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

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/payment/show');
    } else {
        return redirect('/login');
    }
});

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::get('/payment/show', [
        'uses' => 'PaymentController@show',
        'as' => 'payment.show',
    ]);
    Route::post('/payment/store', [
        'uses' => 'PaymentController@store',
        'as' => 'payment.store',
    ]);
});
