<?php
namespace App\Http\Controllers\Api;
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

Route::get('/', function () {
    return view('welcome');
});
//Route::get('docGia', [DocGiaController::class, 'index'])->name('docGia.index');
//Route::post('user/login', [UserController::class, 'login']);
