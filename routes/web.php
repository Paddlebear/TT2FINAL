<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ReadingListController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TagController;

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
Route::get('edit_book/{id}', [BookController::class, 'show'])->middleware('auth.admin')->name('bookupdate');
Route::post('book/update', [BookController::class, 'update'])->middleware('auth.admin'); //???
//Route::get('reading_lists/{name}', [ReadingListController::class, 'userlist'])->middleware('auth')->name('userlist');
Route::get('profile/{name}', [ReadingListController::class, 'userlist'])->middleware('auth')->name('userlist');
Route::get('add_to_list/{bookid}/{userid}', [ReadingListController::class, 'edit'])->middleware('auth')->name('addtolist');
Route::post('add_to_list', [ReadingListController::class, 'addlist'])->middleware('auth')->name('addtolistupdate');
Route::get('all_lists', [AdminController::class, 'adminlist'])->middleware('auth.admin')->name('adminlist');
Route::get('all_books', [AdminController::class, 'adminbook'])->middleware('auth.admin')->name('adminbook');
Route::get('all_users', [AdminController::class, 'adminuser'])->middleware('auth.admin')->name('adminuser');
Route::get('all_tags', [AdminController::class, 'admintags'])->middleware('auth.admin')->name('admintags');
//Route::resource('all_tags', [AdminController::class, 'deletetag'])->middleware('auth.admin');
Route::get('all_genres', [AdminController::class, 'admingenres'])->middleware('auth.admin')->name('admingenres');

Route::get('set-locale/{locale}', function ($locale) {
    App::setLocale($locale);
    session()->put('locale', $locale);
    return redirect('/');
})->middleware('lang')->name('locale.setting');
Route::get('lang/{locale}',LanguageController::class);
