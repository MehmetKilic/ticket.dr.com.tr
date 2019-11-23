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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');
Route::get('/ticket/detail/{id}', 'HomeController@ticketDetail')->name('ticket.detail');
Route::post('/ticket/confirm', 'HomeController@confirm')->name('ticket.confirm');
Route::get('/tag/detail/{name}', 'HomeController@tagDetail')->name('tag.detail');
