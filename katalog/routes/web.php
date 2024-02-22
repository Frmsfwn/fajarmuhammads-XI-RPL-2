<?php

use App\Http\Controllers\admincontroller;
use App\Http\Controllers\katalogController;
use App\Http\Controllers\productController;
use App\Http\Controllers\userController;
use Illuminate\Routing\Route as RoutingRoute;
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

Route::get('/dashboard', [admincontroller::class, 'show']);

Route::get('/addproduct', [productController::class, 'addproduct']);
Route::post('/addproduct', [productController::class, 'storeproduct']);

Route::get('/deleteuser/{user:id}',[admincontroller::class,'deleteuser'])->name('user.delete');