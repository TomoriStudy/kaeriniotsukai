<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController; // 追記
use App\Http\Controllers\ProductsController; // 追記
use App\Http\Controllers\TasksController; // 追記
use App\Http\Controllers\RequestedTasksController; // 追記

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
    return view('dashboard');
});

// Route::group(['middleware' => ['auth']], function () {                                            // 追記
//     Route::group(['prefix' => 'users/{id}'], function () {                                          // 追記
//     // Route::get('/dashboard', [UsersController::class, 'show'])->middleware(['auth'])->name('dashboard');
//     // Route::resource('request_tasks', RequestTasksController::class, ['only' => ['index', 'create', 'store', 'destroy']]);
//         Route::resource('requested_tasks', RequestedTasksController::class, ['only' => ['index', 'create', 'store', 'destroy']]);
//     });
// }); 

Route::get('/dashboard', [UsersController::class, 'show'])->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => ['auth']], function () {                                    // 追記
    Route::resource('users', UsersController::class, ['only' => ['show']]);               // 追記
});                                                                                       // 追記
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::resource('products', ProductsController::class, ['only' => ['index', 'store']]);
    Route::resource('tasks', TasksController::class, ['only' => ['index', 'store', 'edit', 'update', 'destroy']]);
});