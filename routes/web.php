<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserCategoryController;
use App\Http\Controllers\UserPostController;
use App\Http\Controllers\UserUiController;
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

Route::get('/', [UserUiController::class, 'index'])->name('user-index');

Route::middleware('auth')->group(function () {

  Route::get('/posts', [PostController::class, 'index'])->name('posts');
  Route::post('/uploadProfile', [ProfileController::class, 'uploadProfile'])->name('profile.upload');

  //post
  Route::get('/posts', [UserPostController::class, 'index'])->name('posts');
  Route::get('/posts/{id}', [UserPostController::class, 'detail'])->name('posts-detail');
  Route::get('/search', [UserPostController::class, 'search'])->name('posts-search');

  //category
  Route::get('/category', [UserCategoryController::class, 'index'])->name('category');
  Route::get('/category/{id}', [UserCategoryController::class, 'show'])->name('category-show');
});



Route::prefix('admin')->name('admin.')->middleware(['auth', 'IsAdmin'])->group(function () {
  Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
  Route::get('/profile', [AdminProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [AdminProfileController::class, 'destroy'])->name('profile.destroy');
  Route::post('/uploadProfile', [AdminProfileController::class, 'uploadProfile'])->name('profile.upload');


  // user
  Route::get('/users', [UserController::class, 'index'])->name('users');
  Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('user-edit');
  Route::post('/users/edit/{id}', [UserController::class, 'update'])->name('user-update');
  Route::get('/users/delete/{id}', [UserController::class, 'delete'])->name('user-delete');


  //cartegory
  Route::get('categories', CategoryController::class)->name('categories.index');

  //post
  Route::get('/posts', [PostController::class, 'index'])->name('posts');
});

Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
