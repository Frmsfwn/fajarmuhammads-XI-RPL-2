<?php

use App\Http\Controllers\commentController;
use App\Http\Controllers\emailverificationController;
use App\Http\Controllers\katalogController;
use App\Http\Controllers\productController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::middleware(['preventBackHistory','guest'])->group(function(){
    Route::get('/', function() {  
        if (Auth::user() == null){
            return view('katalog.index');
        }elseif (Auth::user()->role == 'admin'){
            return redirect('/access/admin');
        }elseif (Auth::user()-> role == 'user'){
            return redirect('/access/user');
        }
    });
    Route::get('/login', [userController::class, 'login'])->name('login');
    Route::post('/login', [userController::class, 'storelogin']);
    Route::get('/register', [userController::class, 'register']);
    Route::post('/register', [userController::class, 'storeregister']);
    Route::get('/emailverification', [emailverificationController::class, 'emailverification']);
    Route::post('/emailverification', [emailverificationController::class, 'verifyotp']);
    Route::get('/emailverification/resendotp/{user:id}', [emailverificationController::class, 'resendotp']);
});
Route::middleware(['preventBackHistory','auth'])->group(function(){
    Route::get('/home', function() {
        if (Auth::user()->role == 'admin'){
            return redirect('/access/admin');
        }elseif (Auth::user()-> role == 'user'){
            return redirect('/access/user');
        }
    });
    Route::get('/logout', [userController::class, 'logout']);
});
Route::middleware(['preventBackHistory','auth','userAccess:admin'])->group(function(){
    //Admin
    Route::get('/access/admin', [userController::class, 'admin']);
    Route::get('/dashboard', [katalogController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/addproduct', [productController::class, 'addproduct'])->name('product.add');
    Route::post('/addproduct', [productController::class, 'storeproduct']);
    Route::get('/editproduct/{product:id}',[productController::class,'editproduct'])->name('product.edit');
    Route::put('/editproduct/{product:id}',[productController::class,'updateproduct']);
    Route::get('/deleteproduct/{product:id}',[productController::class,'deleteproduct'])->name('product.delete');
    Route::get('/deleteuser/{user:id}',[userController::class,'deleteuser'])->name('user.delete');
});
Route::middleware(['preventBackHistory','auth','userAccess:user'])->group(function(){
    //User
    Route::get('/access/user', [userController::class, 'user']);
    Route::get('/homepage', [katalogController::class, 'homepage']);
    Route::post('/comment/{product:id}',[commentController::class,'storecomment'])->name('comment.add');
    Route::get('/deletecomment/{comment:id}',[commentController::class,'deletecomment'])->name('comment.delete');
    Route::post('/like/{product:id}',[productController::class,'addlike'])->name('like.add');
    Route::get('/unlike{product:id}',[productController::class,'deletelike'])->name('like.delete');
});
Route::get('/test', function() {
    return view('katalog.test');
});