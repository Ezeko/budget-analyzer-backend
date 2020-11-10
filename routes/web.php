<?php

use App\Http\Controllers\HistoriesController;
use Illuminate\Support\Facades\Route;

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
    return redirect('/docs');
});

Route::post('/history/create', [HistoriesController::class,'createHistory']);

Route::get('/histories/{user_id}', [HistoriesController::class,'getHistories']);

Route::get('/histories/{user_id}/{budget_type}', [HistoriesController::class,'getHistory']);
