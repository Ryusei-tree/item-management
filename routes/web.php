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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('items')->group(function () {
    Route::get('/', [App\Http\Controllers\ItemController::class, 'index']);
    Route::get('/add', [App\Http\Controllers\ItemController::class, 'add']);
    Route::post('/add', [App\Http\Controllers\ItemController::class, 'add']);
    // 商品編集画面 表示
    Route::get('/edit/{id}', [App\Http\Controllers\ItemController::class, 'edit']);
    // 商品編集
    Route::post('/itemEdit/{id}', [App\Http\Controllers\ItemController::class, 'itemEdit']);
    // 商品削除
    Route::delete('/delete', [App\Http\Controllers\ItemController::class, 'delete']);

    // 検索機能
    Route::get('/search', [App\Http\Controllers\ItemController::class, 'search']);
});
