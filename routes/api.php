<?php

namespace App\Http\Controllers\Api;
use App\Models\Sach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//readers
Route::get('docGia', [DocGiaController::class, 'index'])->name('docGia.index')->middleware('auth:sanctum');
Route::get('docGia/search', [DocGiaController::class, 'search'])->name('docGia.search')->middleware('auth:sanctum');
Route::post('docGia/update/{id}', [DocGiaController::class, 'update'])->middleware('auth:sanctum');
Route::post('docGia/store', [DocGiaController::class, 'store'])->middleware('auth:sanctum');
Route::post('docGia/delete/{id}', [DocGiaController::class, 'destroy'])->middleware('auth:sanctum');

//staffs
Route::post('user/login', [UserController::class, 'login']);
Route::post('user/register', [UserController::class, 'register']);

//books
Route::get('book', [SachController::class, 'index'])->middleware('auth:sanctum');
Route::get('book/search', [SachController::class, 'search'])->middleware('auth:sanctum');
Route::post('book/store', [SachController::class, 'store'])->middleware('auth:sanctum');
Route::post('book/delete/{id}', [SachController::class, 'destroy'])->middleware('auth:sanctum');
Route::post('book/update/{id}', [SachController::class, 'update'])->middleware('auth:sanctum');

//borrow books
Route::get('borrow', [MuonSachController::class, 'index'])->middleware('auth:sanctum');
Route::post('borrow/store', [MuonSachController::class, 'store'])->middleware('auth:sanctum');
Route::post('borrow/delete/{id}', [MuonSachController::class, 'destroy'])->middleware('auth:sanctum');
Route::post('borrow/update/{id}', [MuonSachController::class, 'update'])->middleware('auth:sanctum');
Route::get('borrow/search', [MuonSachController::class, 'search'])->middleware('auth:sanctum');


//return books
Route::get('return', [TraSachController::class, 'index'])->middleware('auth:sanctum');
Route::post('return/store', [TraSachController::class, 'store'])->middleware('auth:sanctum');
Route::post('return/delete/{id}', [TraSachController::class, 'destroy'])->middleware('auth:sanctum');
Route::post('return/update/{id}', [TraSachController::class, 'update'])->middleware('auth:sanctum');
Route::get('return/search', [TraSachController::class, 'search'])->middleware('auth:sanctum');
