<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

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
//     return new UserResource($request->user());
// });

// Route::middleware('auth:sanctum')->apiResource('posts', PostController::class);

Route::group(['middleware' => 'auth:sanctum'], function(Router $authenticatedRoute){
    $authenticatedRoute->get('/user', function (Request $request) {
        return new UserResource($request->user());
    });

    $authenticatedRoute->apiResource('posts', PostController::class);

    $authenticatedRoute->apiResource('comments', CommentController::class)->except(['index']);
});

Route::post('/login', [LoginController::class, 'login']); 

