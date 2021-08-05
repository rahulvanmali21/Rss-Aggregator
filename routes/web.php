<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedController;
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

Route::get('/', [FeedController::class,"home"])->name('feeds.home');
Route::get('/create', [FeedController::class,"create"])->name('feeds.create');
Route::post('/store', [FeedController::class,"store"])->name('feeds.store');
Route::get('/feeds/{rssFeed}', [FeedController::class,"show"])->name('feeds.view');

