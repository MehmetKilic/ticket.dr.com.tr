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
    return view('welcome');
});

Route::get('/ticket', 'TicketController@showForm')->name('ticket');
Route::post('/ticket', 'TicketController@store')->name('ticketPost');
Route::post('/ticket/confirm', 'TicketController@confirm')->name('ticket.confirm');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'HomeController@profile')->name('profile');
