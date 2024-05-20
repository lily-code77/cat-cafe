<?php

use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('index');
// });

Route::view('/', 'index');

//お問い合わせフォーム
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'sendMail']);
Route::get('/contact/complete', [ContactController::class, 'complete'])->name('contact.complete');

// ブログ
Route::get('/admin/blogs', [AdminBlogController::class, 'index'])->name('admin.blogs.index')->middleware('auth');
Route::get('/admin/blogs/create', [AdminBlogController::class, 'create'])->name('admin.blogs.create')->middleware('auth');
Route::post('/admin/blogs', [AdminBlogController::class, 'store'])->name('admin.blogs.store')->middleware('auth');
Route::get('/admin/blogs/{blog}', [AdminBlogController::class, 'edit'])->name('admin.blogs.edit')->middleware('auth');
Route::put('/admin/blogs/{blog}', [AdminBlogController::class, 'update'])->name('admin.blogs.update')->middleware('auth');
Route::delete('/admin/blogs/{blog}', [AdminBlogController::class, 'destroy'])->name('admin.blogs.destroy')->middleware('auth');

//ユーザ管理
Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create')->middleware('auth');
Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store')->middleware('auth');

//認証
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login')->middleware('guest');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout')->middleware('auth');