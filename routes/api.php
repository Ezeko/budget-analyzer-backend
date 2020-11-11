<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HistoriesController;
use App\Http\Controllers\UsersController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/history/create', [HistoriesController::class,'createHistory']);

Route::get('/histories/{user_id}', [HistoriesController::class,'getHistories']);

Route::get('/histories/{user_id}/{budget_type}', [HistoriesController::class,'getHistory']);

//dashboard histories
Route::get('/dash/histories/{user_id}', [HistoriesController::class,'getDashHistories']);

//store user
Route::post('/user/create', [UsersController::class, 'store']);