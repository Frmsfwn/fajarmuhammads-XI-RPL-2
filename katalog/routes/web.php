<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\commentController;
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
Route::get('/', [katalogController::class, 'index']);

Route::middleware(['guest'])->group(function(){
    Route::get('/login', [katalogController::class, 'login'])->name('login');
    Route::post('/login', [katalogController::class, 'storelogin']);
});

Route::get('/home', function() {
    if (Auth::user()->role == 'admin'){
        return redirect('access/admin');
    }elseif (Auth::user()-> role == 'user'){
        return redirect('access/user');
    }
});

Route::middleware(['auth'])->group(function(){
    Route::get('/access/admin', [userController::class, 'admin'])->middleware('userAccess:admin');
    Route::get('/access/user', [userController::class, 'user'])->middleware('userAccess:user');
    Route::get('/logout', [katalogController::class, 'logout']);
});

Route::get('/register', [userController::class, 'register']);
Route::post('/register', [userController::class, 'storeregister']);

Route::get('/dashboard', [adminController::class, 'show'])->name('admin.dashboard');

Route::get('/addproduct', [productController::class, 'addproduct'])->name('product.add');
Route::post('/addproduct', [productController::class, 'storeproduct']);

Route::get('/editproduct/{product:id}',[productController::class,'editproduct'])->name('product.edit');
Route::put('/editproduct/{product:id}',[productController::class,'updateproduct']);

Route::get('/deleteproduct/{product:id}',[productController::class,'deleteproduct'])->name('product.delete');

Route::get('/deleteuser/{user:id}',[adminController::class,'deleteuser'])->name('user.delete');

Route::get('/comment',[commentController::class,'addcomment']);
Route::post('/comment/{product:id}',[commentController::class,'storecomment'])->name('comment.add');