<?php

use App\Http\Controllers\BrandController;
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

    // For Brand
    Route::get('/brand/all', [BrandController::class, 'index'])->name('all.brand');
    Route::post('/brand/store', [BrandController::class, 'store'])->name('store.brand');
    Route::get('/brand/edit/{id}', [BrandController::class, 'edit'])->name('edit.brand');
    Route::post('/brand/update/{id}', [BrandController::class, 'update'])->name('update.brand');

    Route::get('/brand/trash', [BrandController::class, 'brandTrash'])->name('trash.brand');
    Route::get('/brand/delete/{id}', [BrandController::class, 'destroy'])->name('destroy.brand');
    Route::get('/brand/pdelete/{id}', [BrandController::class, 'pdelete'])->name('pdelete.brand');

    Route::get('/brand/restore/{id}', [BrandController::class, 'restore'])->name('restore.brand');

    // Multi Pics
    Route::get('/multipic', [BrandController::class, 'multipic'])->name('multipic');
    Route::post('/multipic/store', [BrandController::class, 'multipicStore'])->name('multipic.store');
    Route::get('/multipic/destory/{id}', [BrandController::class, 'multipicDestroy'])->name('multipic.destroy');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        $users = DB::table('users')->get();
        $users = User::all();
        return view('dashboard', compact('users'));
    })->name('dashboard');
});
