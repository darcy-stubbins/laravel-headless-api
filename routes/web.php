<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/users', function(){
//     return new UserCollection(User::all()); 
// });

// Route::get('/users/{id}', function($id){
//     return new UserResource(User::find($id)); 
// });

// Route::get('/posts', function(){
//     return new PostCollection(Post::all()); 
// });

// Route::get('/posts/{id}', function($id){
//     return new PostResource(Post::find($id)); 
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

