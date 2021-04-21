<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin;

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
//TODO: 4. 整合頁面
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/form', "PageController@form")->middleware('auth');
Route::get('/pay', "PageController@pay")->middleware('auth');
Route::get('/success', "PageController@success")->middleware('auth');
Route::get('/history', "PageController@history")->middleware('auth');

Route::resource('/timetable', TimeTableController::class)->middleware('auth');
Route::resource('/ticket', TicketController::class)->middleware('auth');
Route::resource('/user', UserController::class);
Route::get('/admin/tickets', "AdminController@showAllTickets")->middleware('auth');
Route::get('/admin/users', "AdminController@showAllUsers")->middleware('auth');
