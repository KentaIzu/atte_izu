<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\RestController;

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

//ユーザー新規登録ページ表示
Route::get('/register', [AuthController::class, 'getRegister']);
//ユーザー新規登録処理
Route::post('/register', [AuthController::class, 'postRegister']);
//ユーザーログインページ表示
Route::get('/login', [AuthController::class,'getLogin'])->name('login');
//ユーザーログイン処理
Route::post('/login', [AuthController::class,'postLogin']);


//ユーザーログアウト処理
Route::get('/logout', [AuthController::class,'getLogout'])->middleware('auth');

//打刻ページ
Route::get('/', [AttendanceController::class,'getIndex'])->middleware('auth');

//日別勤怠ページ表示
Route::get('/attendance/{num}', [AttendanceController::class,'getAttendance'])->middleware('auth');

//勤怠開始処理
Route::post('/attendance/start', [AttendanceController::class,'startAttendance'])->middleware('auth');
//勤怠終了処理
Route::post('/attendance/end', [AttendanceController::class,'endAttendance'])->middleware('auth');

//休憩開始処理
Route::post('/rest/start', [RestController::class,'startRest'])->middleware('auth');
//休憩終了処理
Route::post('/rest/end', [RestController::class,'endRest'])->middleware('auth');

