<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StoreController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('home.index');
})->middleware(['auth', 'role:admin_super,admin,cashier']);

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'process'])->name('login.process');
Route::post('logout', [LoginController::class, 'logout'])->name('login.logout');

// Route::post('logout', function (){return view('home.index');});

Route::middleware(['auth', 'role:admin_super'])->group(function () {
    Route::get('stores', [StoreController::class, 'index'])->name('store.index')->middleware('auth');
    Route::get('stores/manage', [StoreController::class, 'manage'])->name('store.manage')->middleware('auth');
    Route::get('stores/manage/{store:id}', [StoreController::class, 'manage'])->name('store.manage')->middleware('auth');
    Route::get('stores/detail/{store:id}', [StoreController::class, 'detail'])->name('store.detail')->middleware('auth');
    Route::post('stores/manage/store', [StoreController::class, 'store'])->name('store.store')->middleware('auth');
    Route::post('stores/manage/update', [StoreController::class, 'update'])->name('store.update')->middleware('auth');
    Route::get('stores/manage/delete/{store:id}', [StoreController::class, 'delete'])->name('store.delete')->middleware('auth');
});

Route::middleware(['auth', 'role:admin_super'])->group(function () {
    Route::get('users', [UserController::class, 'index'])->name('user.index')->middleware('auth');
    Route::get('users/manage', [UserController::class, 'manage'])->name('user.manage')->middleware('auth');
    Route::get('users/manage/{user:id}', [UserController::class, 'manage'])->name('user.manage')->middleware('auth');
    // Route::post('users/manage', [UserController::class, 'process_add_edit'])->name('user.process-add-edit')->middleware('auth');
    Route::post('users/manage/store', [UserController::class, 'store'])->name('user.store')->middleware('auth');
    Route::post('users/manage/update', [UserController::class, 'update'])->name('user.update')->middleware('auth');
    Route::get('users/manage/delete/{user:id}', [UserController::class, 'delete'])->name('user.delete')->middleware('auth');
});