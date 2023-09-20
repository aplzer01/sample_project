<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\BookController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//チュートリアル
Route::get('/test','App\Http\Controllers\TestController@index');

//インデックスと一覧表示
Route::get('/index',[BookController::class,'index'])->name('book.index');
//検索
Route::get('/search',[BookController::class,'search'])->name('book.search');

//本の登録画面の表示
Route::get('/create',[BookController::class,'create'])->name('book.create');
//本の登録処理
Route::post('/store',[BookController::class,'store'])->name('book.store');
//１件の詳細を表示
Route::get('/detail/{book_id}',[BookController::class,'detail'])->name('book.detail');
//１件編集
Route::get('/edit/{book_id}',[BookController::class,'edit'])->name('book.edit');
Route::post('/update/{book_id}',[BookController::class,'update'])->name('book.update');
//１件削除
Route::post('/delete/{book_id}',[BookController::class,'delete'])->name('book.delete');
//CSVダウンロード
Route::get('/downloadCsv',[BookController::class,'downloadCsv'])->name('book.downloadCsv');

require __DIR__.'/auth.php';
