<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Laravel\Passport\Http\Controllers\ApproveAuthorizationController;
use Laravel\Passport\Http\Controllers\DenyAuthorizationController;
use Psr\Http\Message\ServerRequestInterface;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('/contacts', "App\Http\Controllers\ContactController@index")->middleware('custom_auth');
// Route::post('/login', "App\Http\Controllers\ContactController@index")->middleware('custom_auth');

// Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('me', [AuthController::class, 'me'])->middleware('auth:api');

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:api')->post('/user', function (Request $request) {
    return $request->user();
});




Route::post('oauth/authorize', [ApproveAuthorizationController::class, 'approve']);
Route::delete('oauth/authorize', [DenyAuthorizationController::class, 'deny']);
Route::post('oauth/token', [AccessTokenController::class, 'issueToken'])->middleware('throttle');