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
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');

Route::post('add-filter', "App\Http\Controllers\FilterController@addFilter")->middleware('auth:api');
Route::post('add-image', "App\Http\Controllers\ImageController@addImage")->middleware('auth:api');
Route::post('update-image', "App\Http\Controllers\ImageController@updateImage")->middleware('auth:api');
Route::post('delete-image', "App\Http\Controllers\ImageController@deleteImage")->middleware('auth:api');
Route::post('add-page', "App\Http\Controllers\PageController@addPage")->middleware('auth:api');
Route::post('update-page', "App\Http\Controllers\PageController@updatePage")->middleware('auth:api');
Route::post('delete-page', "App\Http\Controllers\PageController@deletePage")->middleware('auth:api');
Route::post('save-contacts', "App\Http\Controllers\ContactsController@saveContacts")->middleware('auth:api');
Route::post('save-main-page', "App\Http\Controllers\MainPageController@saveMainPage")->middleware('auth:api');
Route::post('save-admin', "App\Http\Controllers\AdminController@saveAdmin")->middleware('auth:api');


Route::post('get-filters', "App\Http\Controllers\FilterController@getFilters");
Route::post('get-main-page', "App\Http\Controllers\MainPageController@getMainPage");
Route::post('get-filter-admin', "App\Http\Controllers\FilterController@getFilterAdmin")->middleware('auth:api');
Route::post('update-filter', "App\Http\Controllers\FilterController@updateFilter")->middleware('auth:api');
Route::post('delete-filter', "App\Http\Controllers\FilterController@deleteFilter")->middleware('auth:api');
Route::get('get-images', "App\Http\Controllers\ImageController@getImages");
Route::get('get-category-images', "App\Http\Controllers\ImageController@getCategoryImages");
Route::post('get-likes', "App\Http\Controllers\ImageController@getLikes");
Route::post('get-images-admin', "App\Http\Controllers\ImageController@getImagesAdmin")->middleware('auth:api');
Route::post('get-contacts', "App\Http\Controllers\ContactsController@getContacts");
Route::post('get-admin', "App\Http\Controllers\AdminController@getAdmin");
Route::post('get-page', "App\Http\Controllers\PageController@getPage");
Route::post('get-pages', "App\Http\Controllers\PageController@getPages");
Route::post('get-pages-admin', "App\Http\Controllers\PageController@getPagesAdmin")->middleware('auth:api');
Route::post('get-page-admin', "App\Http\Controllers\PageController@getPageAdmin")->middleware('auth:api');
Route::post('get-image-admin', "App\Http\Controllers\ImageController@getImageAdmin");
Route::get('get-email-token', "App\Http\Controllers\AdminController@getEmailToken");
Route::post('send-email', "App\Http\Controllers\AdminController@sendEmail");
// Route::post('cv', "App\Http\Controllers\ImageController@cve");
// Route::middleware('auth:api')->group(function () {
//     Route::post('/logout', [AuthController::class, 'logout']);
// });

Route::middleware('auth:api')->post('/user', function (Request $request) {
    return $request->user();
});




Route::post('oauth/authorize', [ApproveAuthorizationController::class, 'approve']);
Route::delete('oauth/authorize', [DenyAuthorizationController::class, 'deny']);
Route::post('oauth/token', [AccessTokenController::class, 'issueToken'])->middleware('throttle');