<?php

use App\Http\Controllers\ProductController;
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

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });



Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');

    Route::group(['prefix' => 'products'], function () {
        Route::get('/{product}', [ProductController::class, 'show'])->name('prdoucs.detail');
    });
});