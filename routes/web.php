<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormController;


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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/form', "FormController@index");
Route::post('/form', "TimeTableController@store");
Route::apiResource('/ticket', TicketController::class);
Route::get('/ticketss', function () {
    return view('ticket');
});
