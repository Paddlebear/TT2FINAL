<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ReadingListController;
use App\Http\Controllers\BookController;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/dashboard', function () {
    //Route::resource('home', ReadingListController::class);
    //return view('all_reading_lists');
    Route::redirect('/', 'home');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::redirect('/', 'home');
Route::resource('home', ReadingListController::class);
Route::resource('books', BookController::class, ['except' => ['index', 'create']]);
Route::get('books', [BookController::class, 'index']);
Route::get('add_book', [BookController::class, 'create']);
Route::get('add_reading_list', [ReadingListController::class, 'create']);
Route::get('delete_reading_list/{id}', [ReadingListController::class, 'showdelete']);
Route::get('reading_lists/{listname}', [ReadingListController::class, 'showlist']);
Route::post('book/update', [BookController::class, 'update']);
