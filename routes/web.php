<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TweetController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TweetController::class,'index'])->name('home');
Route::get('/tweet/{tweet}', [TweetController::class,'view'])->name('view.tweet');
Route::post('/tweet/create',[TweetController::class,'store'])->name('tweet.create');
Route::get('/login', [LoginController::class,'create'])->name('login');
Route::post('/login', [LoginController::class,'store']);
Route::get('/register', [RegisterController::class,'create'])->name('register');
Route::post('/register', [RegisterController::class,'store']);
Route::post('/logout',[LogoutController::class,'__invoke'])->name('logout');
Route::get('/account/{account}',[AccountController::class,'view'])->name('account');
Route::get('/account/settings/{account}',[AccountController::class,'edit'])->name('account.edit');
Route::post('/account/update/{account}',[AccountController::class,'update'])->name('account.update');
Route::post('/tweets/{tweet}/like', [TweetController::class,'like'])->name('tweets.like');
Route::delete('/tweet/{tweet}/delete',[TweetController::class,'delete'])->name('tweet.delete');