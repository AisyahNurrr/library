<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

// Rute untuk menampilkan semua buku
Route::get('/books', [BookController::class, 'loadAllBooks'])->name('books');

// Rute untuk menampilkan form menambah buku
Route::get('/add/book', [BookController::class, 'loadAddBookForm'])->name('addBookForm');

// Rute untuk menyimpan buku baru
Route::post('/add/book', [BookController::class, 'addBook'])->name('addBook');

// Rute untuk menampilkan form edit buku
Route::get('/edit/{kode_buku}', [BookController::class, 'loadEditForm'])->name('editBookForm');

// Rute untuk memperbarui buku
Route::post('/edit/book', [BookController::class, 'editBook'])->name('editBook');

// Rute untuk menghapus buku
Route::delete('/delete/{kode_buku}', [BookController::class, 'deleteBook'])->name('deleteBook');

// Rute untuk Registrasi
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('register.submit');

// Rute untuk Login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.submit');

// Rute untuk Logout - update to use LoginController
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Grouped Routes that require authentication
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [BookController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [BookController::class, 'profile'])->name('profile');
    Route::get('/profil', [BookController::class, 'profile'])->name('profil');
    Route::get('/buku/tersedia', [BookController::class, 'showAvailableBooks'])->name('buku.tersedia');
});

// Rute untuk menampilkan detail buku
Route::get('/books/{kode_buku}', [BookController::class, 'showBookDetails'])->name('book.details');
