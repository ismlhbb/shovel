<?php

use Illuminate\Support\Facades\Auth;
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
    return view('auth.login');
});

Auth::routes();
// Menghapus fitur registrasi
Route::match(["GET", "POST"], "/register", function () {
    return redirect("/login");
})->name("register");

Route::get('/home', 'HomeController@index')->name('home');

// Management User
Route::resource("users", "UserController");

// Melihat trash category
Route::get('/categories/trash', 'CategoryController@trash')->name('categories.trash');
// Mengatur restore trashed category
Route::get('/categories/{id}/restore', 'CategoryController@restore')->name('categories.restore');
// Mengatur delete permanent category
Route::delete('/categories/{category}/delete-permanent', 'CategoryController@deletePermanent')->name('categories.delete-permanent');
// Management Categories
Route::resource('categories', 'CategoryController');
//route untuk mencari kategori berdasarkan keyword. Route ini akan digunakan oleh select2 nantinya
Route::get('/ajax/categories/search', 'CategoryController@ajaxSearch');



// melihat trash book
Route::get('/books/trash', 'BookController@trash')->name('books.trash');
//mengarur restore trashed book
Route::post('/books/{book}/restore', 'BookController@restore')->name('books.restore');
// mengatur delete permanent book
Route::delete('/books/{id}/delete-permanent', 'BookController@deletePermanent')->name('books.delete-permanent');

// Management Books
Route::resource('books', 'BookController');

Route::resource('orders', 'OrderController');
