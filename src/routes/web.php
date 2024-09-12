<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\StoreReviewController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StoreOwnerController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Spatie\Permission\Middleware\RoleMiddleware;
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
    Route::get('/user_menu',[StoreController::class,'user_menu']);
    Route::get('/search',[StoreController::class,'search']);
    Route::post('/favorite_store',[StoreController::class,'favorite']);
    Route::get('/detail/{id}',[StoreController::class,'store_detail']);
    Route::get('/mypage/{id}',[StoreController::class,'mypage']);
    Route::post('/store/review',[StoreReviewController::class,'store_review']);
    Route::post('/reservation',[ReservationController::class,'reservation_create']);
    Route::get('/thanks',[StoreController::class,'thanks']);
    Route::post('/reservation/delete',[ReservationController::class,'reservation_delete']);
    Route::get('/reservation/detail/{id}',[ReservationController::class,'reservation_detail']);
    Route::post('/reservation/detail/update',[ReservationController::class,'reservation_update']);
});

Route::get('/register_menu',[StoreController::class,'register_menu']);
Route::get('/login_menu',[StoreController::class,'login_menu']);
Route::get('/back',[ReservationController::class,'back']);

Route::group(['middleware' => ['auth','role:admin']], function(){
    Route::get('/admin',[AdminController::class, 'admin_index'])->name('admin');
    Route::get('/admin/users',[AdminController::class, 'admin_users'])->name('admin.users.index');
    Route::post('/admin/users/delete',[AdminController::class, 'admin_user_delete'])->name('admin.user.delete');
    Route::post('/admin/users/role',[AdminController::class, 'admin_user_assignRole'])->name('admin.user.assignRole');
    Route::post('/admin/users/update',[AdminController::class, 'admin_user_update'])->name('admin.user.update');
    Route::get('/admin/stores',[AdminController::class, 'admin_stores'])->name('admin.stores.index');
    Route::get('/admin/store_owners',[AdminController::class, 'admin_store_owners'])->name('admin.store.owners');
    Route::post('/admin/add_store_owner',[AdminController::class, 'admin_add_store_owner'])->name('admin.add.store.owner');
});

Route::group(['middleware' => ['auth','role:store_owner']], function(){
    Route::get('/store_owner', [StoreOwnerController::class, 'store_owner'])->name('store_owner');
    Route::get('/store/info', [StoreOwnerController::class, 'store_info'])->name('store.info');
    Route::post('/store/info/update', [StoreOwnerController::class, 'store_info_update'])->name('store.info.update');
    Route::get('/store/reservation', [StoreOwnerController::class, 'store_reservation'])->name('store.reservation');
});


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
