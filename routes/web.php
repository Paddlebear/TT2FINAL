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

//Route::get('/dashboard', function () {
//    //Route::resource('home', ReadingListController::class);
//    //return view('all_reading_lists');
//    Route::redirect('/', 'home');
//})->middleware(['auth'])->name('home');

require __DIR__.'/auth.php';

Route::redirect('/', 'home')->name('home');
Route::resource('home', ReadingListController::class);
Route::resource('books', BookController::class, ['except' => ['index', 'create']]);
Route::get('books', [BookController::class, 'index'])->name('books');
Route::get('add_book', [BookController::class, 'create'])->middleware('auth')->name('addbook');
Route::get('add_reading_list/{id}', [ReadingListController::class, 'create'])->middleware('auth')->name('addlist');
Route::get('delete_reading_list/{id}', [ReadingListController::class, 'showdelete'])->middleware('auth')->name('deletelist');
Route::get('reading_lists/{listname}', [ReadingListController::class, 'showlist'])->name('list');
//Route::get('book/{id}/update', [BookController::class, 'show'])->middleware('auth')->name('bookupdate');
Route::post('book/update', [BookController::class, 'update'])->middleware('auth'); //???
//Route::get('reading_lists/{name}', [ReadingListController::class, 'userlist'])->middleware('auth')->name('userlist');
Route::get('profile/{name}', [ReadingListController::class, 'userlist'])->middleware('auth')->name('userlist');
Route::get('add_to_list/{bookid}/{userid}', [ReadingListController::class, 'edit'])->middleware('auth')->name('addtolist');
Route::post('add_to_list', [ReadingListController::class, 'addlist'])->middleware('auth')->name('addtolistupdate');
