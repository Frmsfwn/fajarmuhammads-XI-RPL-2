<?php

use App\Http\Controllers\commentController;
use App\Http\Controllers\emailverificationController;
use App\Http\Controllers\katalogController;
use App\Http\Controllers\productController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function() {  
    if (Auth::user() == null){
        return view('katalog.index');
    }elseif (Auth::user()->role == 'admin'){
        return redirect('/access/admin');
    }elseif (Auth::user()-> role == 'user'){
        return redirect('/access/user');
    }
});

Route::get('/home', function() {
    if (Auth::user()->role == 'admin'){
        return redirect('/access/admin');
    }elseif (Auth::user()-> role == 'user'){
        return redirect('/access/user');
    }
});

Route::middleware(['guest'])->group(function(){
    Route::get('/login', [userController::class, 'login'])->name('login');
    Route::post('/login', [userController::class, 'storelogin']);
    Route::get('/register', [userController::class, 'register']);
    Route::post('/register', [userController::class, 'storeregister']);
});

Route::middleware(['auth'])->group(function(){
    //Admin
    Route::get('/access/admin', [userController::class, 'admin'])->middleware('userAccess:admin');
    Route::get('/dashboard', [katalogController::class, 'dashboard'])->middleware('userAccess:admin');
    Route::get('/addproduct', [productController::class, 'addproduct'])->name('product.add')->middleware('userAccess:admin');
    Route::post('/addproduct', [productController::class, 'storeproduct'])->middleware('userAccess:admin');
    Route::get('/editproduct/{product:id}',[productController::class,'editproduct'])->name('product.edit')->middleware('userAccess:admin');
    Route::put('/editproduct/{product:id}',[productController::class,'updateproduct'])->middleware('userAccess:admin');
    Route::get('/deleteproduct/{product:id}',[productController::class,'deleteproduct'])->name('product.delete')->middleware('userAccess:admin');
    Route::get('/deleteuser/{user:id}',[userController::class,'deleteuser'])->name('user.delete')->middleware('userAccess:admin');

    //User
    Route::get('/access/user', [userController::class, 'user'])->middleware('userAccess:user');
    Route::get('/homepage', [katalogController::class, 'homepage'])->middleware('userAccess:user');

    Route::post('/comment/{product:id}',[commentController::class,'storecomment'])->name('comment.add');

    Route::get('/logout', [userController::class, 'logout']);
});

Route::post('/like/{product:id}',[productController::class,'addlike'])->name('like.add');
Route::get('/unlike{product:id}',[productController::class,'deletelike'])->name('like.delete');

Route::get('/emailverification', [emailverificationController::class, 'emailverification']);
Route::post('/emailverification', [emailverificationController::class, 'verifyotp']);
Route::get('/emailverification/resendotp/{user:id}', [emailverificationController::class, 'resendotp']);

Route::get('/test', function() {
    return view('katalog.test');
});