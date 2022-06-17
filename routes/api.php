<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DestinationController;
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

// User login, register, logout
Route::post('/v1/login', [UserController::class, 'login']);
Route::post('/v1/logout', [UserController::class, 'logout']);
Route::post('/v1/register', [UserController::class, 'store']);

//Create new Destination
Route::post('/v1/destination/create', [DestinationController::class, 'store']);
//Update Destination
Route::put('/v1/destination/update', [DestinationController::class, 'update']);
//Get All Destination
Route::get('/v1/destination', [DestinationController::class, 'get']);
//Delete Destination
Route::delete('/v1/destination/delete/{id}', [DestinationController::class, 'destroy']);
//ADD More Image Destination
Route::post('/v1/destination/addimage', [DestinationController::class, 'addImageDestination']);
//Get Destination by Name
Route::get('/v1/destination/{slug}', [DestinationController::class, 'getByName']);
// Get Trending Tours
Route::get('/v1/destination/type/trending', [DestinationController::class, 'getTrendingTours']);
// Get Top Destinations
Route::get('/v1/destination/type/top', [DestinationController::class, 'getTopDestinations']);


// Post Comment
Route::post('/v1/comment/create', [CommentController::class, 'store']);
//GET Comment by destionation ID
Route::get('/v1/comment/{id}', [CommentController::class, 'getByDestinationId']);