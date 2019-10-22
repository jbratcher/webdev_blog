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

// Vue router catch all

Route::get('/{any}', 'SpaController@index')->where('any', '.*');

// Contact form submission

Route::post('/submit', 'ContactFormController@submit');
