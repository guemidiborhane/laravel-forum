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

if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', function () {
  return redirect(route('chatter.home'), 301);
});

Route::get('/report/post/{post}', 'ReportsController@post')->name('report.post');
Route::get('/report/user/{user}', 'ReportsController@user')->name('report.user');
