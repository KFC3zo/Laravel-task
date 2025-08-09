<?php
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// حماية الروتات دي بالتوكن
Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('/user-profile', function () {
        return auth()->user();
    });
});
use App\Http\Controllers\PostController;

Route::get('/posts', [PostController::class, 'index']);
Route::post('/posts', [PostController::class, 'store'])->middleware('auth:sanctum');

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return 'Welcome Admin';
    });

    Route::resource('admin/users', Admin\UserController::class);
    Route::resource('admin/posts', Admin\PostController::class);
});

use App\Http\Controllers\Admin\UserController;

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return response()->json(['message' => 'Welcome Admin']);
    });



    
});

