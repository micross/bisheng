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
Route::namespace('Home')->middleware([])->group(function () {
    Route::get('', 'IndexController@index')->name('home.index');
    Route::get('reg/reg', 'RegController@index')->name('home.reg');
    Route::get('reg/ajaxCheckEmail', 'RegController@checkEmail')->name('home.checkemail');
});

Route::namespace('Admin')->prefix('admin')->middleware([])->group(function () {
    Route::get('/', 'IndexController@index')->name('admin.index');
});
