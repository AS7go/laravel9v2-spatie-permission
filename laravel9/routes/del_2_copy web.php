<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
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

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [PostController::class, 'index'])->name('dashboard');
    
    Route::get('add-post', [PostController::class, 'create'])->name('add-post');
    Route::post('store-post', [PostController::class, 'store'])->name('store-post');
    Route::get('edit-post/{id}', [PostController::class, 'edit'])->name('edit-post');
    Route::put('update-post/{id}', [PostController::class, 'update'])->name('update-post');
    Route::delete('delete-post/{id}', [PostController::class, 'delete'])->name('delete-post');
    
    
    Route::resource('/roles', RoleController::class);
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

// Route::get('/dashboard',[PostController::class, 'index'])->middleware(['auth'])->name('dashboard');
// Route::get('add-post',[PostController::class, 'create'])->name('add-post');
// Route::post('store-post',[PostController::class, 'store'])->name('store-post');
// Route::get('edit-post/{id}',[PostController::class, 'edit'])->name('edit-post');
// Route::put('update-post/{id}',[PostController::class, 'update'])->name('update-post');
// Route::delete('delete-post/{id}',[PostController::class, 'delete'])->name('delete-post');

require __DIR__ . '/auth.php';
