<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\RestController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\VerifyEmailController;

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
//確認メール送信後ページ
Route::get('/emailcheck', [AuthController::class, 'emailCheck']);
//ユーザーログインページ表示
Route::get('/login', [AuthController::class,'getLogin'])->name('login');
//ユーザーログイン処理
Route::post('/login', [AuthController::class,'postLogin']);

//ユーザーログアウト処理
Route::get('/logout', [AuthController::class,'getLogout'])->middleware('auth');

//打刻ページ
Route::get('/', [AttendanceController::class,'getIndex'])->middleware('auth');

//日別勤怠ページ
Route::get('/attendance/{num}', [AttendanceController::class,'getAttendance'])->middleware('auth');
//ユーザー一覧ページ
Route::get('/userlist', [AttendanceController::class, 'getUserList'])->middleware('auth');
//ユーザー毎の勤怠ページ
Route::get('/userattendance/{num}', [AttendanceController::class, 'getUserAttendance'])->middleware('auth');

//勤怠開始処理
Route::post('/attendance/start', [AttendanceController::class,'startAttendance'])->middleware('auth');
//勤怠終了処理
Route::post('/attendance/end', [AttendanceController::class,'endAttendance'])->middleware('auth');

//休憩開始処理
Route::post('/rest/start', [RestController::class,'startRest'])->middleware('auth');
//休憩終了処理
Route::post('/rest/end', [RestController::class,'endRest'])->middleware('auth');

//メール確認の通知
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
//メール確認のハンドラ
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');
//メール確認の再送信
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);
});

require __DIR__ . '/auth.php';