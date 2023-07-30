<?php

use App\Http\Controllers\HomeController;
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

Route::get('/',[HomeController::class,'index']);
Route::get('/directory',[HomeController::class,'directory']);
Route::get('/delete-file',[HomeController::class,'deleteFile']);
Route::get('/move-file',[HomeController::class,'moveFile']);
Route::get('/change-name',[HomeController::class,'changeName']);
Route::get('/create-dir',[HomeController::class,'createDir']);



