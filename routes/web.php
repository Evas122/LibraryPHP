<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use App\Http\Controllers\BookTransactionController;
use App\Http\Controllers\BookRequestController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/books', [BookController::class, 'index'])->name('books.index');

Route::middleware([AdminMiddleware::class])->group(function ()
{
    Route::get('books/create', [BookController::class, 'createBook'])->name('books.createBook');
    Route::post('books/create', [BookController::class, 'addBook'])->name('books.addBook');
    Route::get('books/{book}/edit', [BookController::class, 'editBook'])->name('books.editBook');
    Route::put('books/{book}/update', [BookController::class, 'updateBook'])->name('books.updateBook');
    Route::delete('/books/{book}/delete', [BookController::class, 'deleteBook'])->name('books.deleteBook');

    Route::get('admin/bookRequests', [BookRequestController::class, 'bookRequests'])->name('admin.bookRequests');
    Route::get('admin/issuedBooks', [BookTransactionController::class, 'issuedBooks'])->name('admin.issuedBooks');
    Route::get('admin/returnedBooks', [BookTransactionController::class, 'returnedBooks'])->name('admin.returnedBooks');
    Route::get('admin/userList', [AdminController::class, 'usersList'])->name('admin.usersList');
    Route::put('admin/userList/{user}', [AdminController::class, 'verifyUser'])->name('admin.verifyUser');
    Route::delete('admin/userList/{user}/delete', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
    Route::delete('admin/bookRequests/{bookrequest}/delete', [BookRequestController::class, 'deleteRequest'])->name('admin.deleteRequest');
    Route::post('admin/bookRequests/{bookrequest}/accept', [BookRequestController::class, 'acceptRequest'])->name('admin.acceptRequest');
    Route::post('admin/issuedBooks/{booktransaction}/return', [BookTransactionController::class, 'returnBook'])->name('admin.returnBook');
});

Route::middleware([UserMiddleware::class])->group(function ()
{
    Route::get('user/books/{book}/request', [BookRequestController::class, 'requestMake'])->name('books.requestMake');
    Route::post('user/books/{book}/requestSend', [BookRequestController::class, 'requestSend'])->name('books.requestSend');
    Route::get('user/issuedBooks', [BookTransactionController::class, 'issuedBooksUser'])->name('user.issuedBooks');
    Route::get('user/returnedBooks', [BookTransactionController::class, 'returnedBooksUser'])->name('user.returnedBooks');
});

require __DIR__.'/auth.php';
