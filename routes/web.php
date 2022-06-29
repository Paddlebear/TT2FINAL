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

Route::redirect('/', 'home')->name('home')->middleware('log');
Route::resource('home', ReadingListController::class);
Route::resource('books', BookController::class, ['except' => ['index', 'create']]);
Route::get('books', [BookController::class, 'index'])->middleware('log')->name('books');
Route::get('search_books', [BookController::class, 'showFilter'])->middleware('log')->name('searchbooks');
Route::post('filter_books', [BookController::class, 'filter'])->middleware('log');
Route::get('search_lists', [ReadingListController::class, 'showFilter'])->middleware('log')->name('searchlists');
Route::post('filter_lists', [ReadingListController::class, 'filter'])->middleware('log');
Route::get('add_book', [BookController::class, 'create'])->middleware('auth','log')->name('addbook');
Route::get('add_tag', [TagController::class, 'create'])->middleware('auth.admin','log')->name('addtag');
Route::get('add_reading_list/{id}', [ReadingListController::class, 'create'])->middleware('auth','log')->name('addlist');
Route::get('delete_reading_list/{id}', [ReadingListController::class, 'showdelete'])->middleware('auth','log')->name('deletelist');
Route::get('reading_lists/{listname}', [ReadingListController::class, 'showlist'])->name('list','log');
Route::get('edit_book/{id}', [BookController::class, 'show'])->middleware('auth.admin','log')->name('bookupdate');
Route::get('edit_list/{id}', [ReadingListController::class, 'show'])->middleware('auth','log')->name('listupdate');
Route::post('book/update', [BookController::class, 'update'])->middleware('auth.admin','log'); //???
Route::post('list/update', [ReadingListController::class, 'update'])->middleware('auth','log'); //???
//Route::get('reading_lists/{name}', [ReadingListController::class, 'userlist'])->middleware('auth')->name('userlist');
Route::get('profile/{name}', [ReadingListController::class, 'userlist'])->middleware('auth','log')->name('userlist');
Route::get('add_to_list/{bookid}/{userid}', [ReadingListController::class, 'edit'])->middleware('auth','log')->name('addtolist');
Route::post('add_to_list', [ReadingListController::class, 'addlist'])->middleware('auth','log')->name('addtolistupdate');
Route::get('add_tags_to_list/{listid}', [ReadingListController::class, 'edittags'])->middleware('auth','log')->name('addtagtolist');
Route::post('add_tags_to_list', [ReadingListController::class, 'addlisttags'])->middleware('auth','log')->name('addtagtolistupdate');
Route::get('admin/lists', [AdminController::class, 'adminlist'])->middleware('auth.admin','log')->name('adminlist');
Route::get('admin/books', [AdminController::class, 'adminbook'])->middleware('auth.admin','log')->name('adminbook');
Route::get('admin/users', [AdminController::class, 'adminuser'])->middleware('auth.admin','log')->name('adminuser');
Route::get('admin/users/{id}', [AdminController::class, 'showdelete'])->middleware('auth.admin','log');
Route::resource('users', AdminController::class, ['except' => ['index', 'create']]);
Route::get('admin/tags', [AdminController::class, 'admintags'])->middleware('auth.admin','log')->name('admintags');
Route::get('admin/tags/{id}', [TagController::class, 'showdelete'])->middleware('auth.admin','log');
Route::resource('tags', TagController::class, ['except' => ['index', 'create']]);

Route::get('set-locale/{locale}', function ($locale) {
    App::setLocale($locale);
    session()->put('locale', $locale);
    return redirect('/');
})->middleware('lang')->name('locale.setting');
Route::get('lang/{locale}',LanguageController::class);
