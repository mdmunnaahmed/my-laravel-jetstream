<?php

use App\Http\Controllers\CategoryController;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/category/all', [CategoryController::class, 'index'])->name('all.category');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('store.category');

    Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('edit.category');
    Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('update.category');
    Route::get('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('delete.category');
    Route::get('/category/pdelete/{id}', [CategoryController::class, 'pdelete'])->name('pdelete.category');

    Route::get('/category/restore/{id}', [CategoryController::class, 'restore'])->name('restore.category');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $users = DB::table('users')->get();
        $users = User::all();
        return view('dashboard', compact('users'));
    })->name('dashboard');
});
