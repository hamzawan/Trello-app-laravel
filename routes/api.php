<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
#user routes
Route::post('user/', [UserController::class, "create"]);
Route::get('user/', [UserController::class, "index"]);
Route::get('user/{user}/', [UserController::class, "show"]);
Route::put('user/{user}/', [UserController::class, "update"]);
Route::delete('user/{user}/', [UserController::class, "destroy"]);
Route::post('profile_pic/{user}/', [UserController::class, "update_profile"]);
Route::post('cover_pic/{user}/', [UserController::class, "update_cover"]);

#ticket routes
Route::post('ticket/', [TicketController::class, "create"]);
Route::get('ticket/', [TicketController::class, "index"]);
Route::get('ticket/{ticket}/', [TicketController::class, "show"]);
Route::put('ticket/{ticket}/', [TicketController::class, "update"]);
Route::delete('ticket/{ticket}/', [TicketController::class, "destroy"]);
Route::post('update_image/{ticket}/', [TicketController::class, "update_pic"]);

#auth routes
Route::post('login/', [AuthController::class, "login"]);
Route::post('logout/', [AuthController::class, "logout"]);