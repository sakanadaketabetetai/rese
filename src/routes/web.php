<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ReservationController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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
Route::middleware(['auth','verified'])->group(function(){
    Route::get('/',[StoreController::class,'index']);
});

Route::get('/thanks',[StoreController::class,'thanks']);
Route::get('/register_menu',[StoreController::class,'register_menu']);
Route::get('/login_menu',[StoreController::class,'login_menu']);
Route::get('/user_menu',[StoreController::class,'user_menu']);
Route::get('/search',[StoreController::class,'search']);
Route::post('/favorite_store',[StoreController::class,'favorite']);
Route::get('/detail/{id}',[StoreController::class,'store_detail']);
Route::get('/mypage/{id}',[StoreController::class,'mypage']);
Route::post('/reservation',[ReservationController::class,'reservation_create']);
Route::post('/reservation/delete',[ReservationController::class,'reservation_delete']);
Route::get('/back',[ReservationController::class,'back']);


Route::get('/email/verify', function(){
    return view('auth.verify-email');
})->middleware(['auth'])->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/thanks'); // 認証後のリダイレクト先を指定
})->middleware(['auth', 'signed'])->name('verification.verify');

// メール認証通知の再送信
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
