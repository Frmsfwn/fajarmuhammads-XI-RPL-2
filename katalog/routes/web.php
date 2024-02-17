<?php

use App\Http\Controllers\katalogController;
use App\Http\Controllers\commentController;
use App\Http\Controllers\likeController;
use App\Http\Controllers\productController;
use App\Http\Controllers\userController;
use App\Models\katalog;
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
Route::middleware(['guest'])->group(function(){
    Route::get('/', [katalogController::class, 'index']);
    Route::get('/login', [katalogController::class, 'login']);
    Route::post('/login', [katalogController::class, 'storelogin']);
});
Route::get('/home', function() {
    return redirect('/admin');
});


Route::get('/admin', [katalogController::class, 'admin']);