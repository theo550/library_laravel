<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookVersionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', [UserController::class, 'login']);
Route::post('logout/{id}', [UserController::class, 'logout']);

Route::middleware('auth:sanctum')->get('user', [UserController::class, 'getCurrentUser']);

// books
Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{id}', [BookController::class, 'show']);
Route::get('/book_tag/{id}', [BookController::class, 'getBookByTag']);
Route::get('/book_author/{id}', [BookController::class, 'getBookByAuthor']);
Route::post('/books', [BookController::class, 'store']);
Route::delete('/books/{id}', [BookController::class, 'destroy']);
Route::put('/books/{id}', [BookController::class, 'update']);

Route::middleware('auth:sanctum')->get('/books/{id}/stats', [BookController::class, 'stats']);
Route::get('/books/top/{id}', [BookController::class, 'getTopBook']);

//BookVersion
Route::get('bookversion', [BookVersionController::class, 'index']);
Route::get('bookversion/{id}', [BookVersionController::class, 'show']);
Route::post('bookversion', [BookVersionController::class, 'store']);
Route::delete('bookversion/{id}', [BookVersionController::class, 'destroy']);
Route::put('bookversion/{id}', [BookVersionController::class, 'update']);

Route::get('bookversion/{id}/stats', [BookVersionController::class, 'stats']);

// authors
Route::get('/authors', [AuthorController::class, 'index']);
Route::get('/authors/{id}', [AuthorController::class, 'show']);
Route::get('/author/{id}', [AuthorController::class, 'getAuthorBooks']);
Route::post('/authors', [AuthorController::class, 'store']);
Route::delete('/authors/{id}', [AuthorController::class, 'destroy']);
Route::put('/authors/{id}', [AuthorController::class, 'update']);

Route::get('/authors/{id}/stats', [AuthorController::class, 'stats']);

//tags
Route::get('tags', [TagController::class, 'index']);
Route::get('tags/{id}', [TagController::class, 'show']);
Route::post('tags', [TagController::class, 'store']);
Route::delete('tags/{id}', [TagController::class, 'destroy']);
Route::put('tags/{id}', [TagController::class, 'update']);

// users
Route::get('users', [UserController::class, 'index']);
Route::get('users/{id}', [UserController::class, 'show']);
Route::post('users', [UserController::class, 'store']);
Route::delete('users/{id}', [UserController::class, 'destroy']);
Route::put('users/{id}', [UserController::class, 'update']);

Route::get('users/stats/{id}', [UserController::class, 'stats']);

//comments
Route::get('comments', [CommentController::class, 'index']);
Route::get('comments/{id}', [CommentController::class, 'show']);
Route::post('comments', [CommentController::class, 'store']);
Route::delete('comments/{id}', [CommentController::class, 'destroy']);
Route::put('comments/{id}', [CommentController::class, 'update']);

// library
Route::get('library', [LibraryController::class, 'index']);
Route::get('library/{id}', [LibraryController::class, 'show']);
Route::post('library', [LibraryController::class, 'store']);
Route::delete('library/{id}', [LibraryController::class, 'destroy']);
Route::put('library/{id}', [LibraryController::class, 'update']);

// wishlist
Route::get('wishlist', [WishlistController::class, 'index']);
Route::get('wishlist/{id}', [WishlistController::class, 'show']);
Route::post('wishlist', [WishlistController::class, 'store']);
Route::delete('wishlist/{id}', [WishlistController::class, 'destroy']);
Route::put('wishlist/{id}', [WishlistController::class, 'update']);
