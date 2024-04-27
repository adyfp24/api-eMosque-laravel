<?php

use App\Http\Controllers\api\auth\LogoutController;
use App\Http\Controllers\api\KasController;
use App\Http\Controllers\api\QurbanController;
use App\Http\Controllers\api\auth\LoginController;
use App\Http\Controllers\api\auth\RegistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/coba', function (){
    return response()->json(['test' => 'test ini brow'], 200);
});

Route::post('/register', [RegistController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [LogoutController::class, 'logout']);
    Route::post('/qurban', [QurbanController::class,'createQurban']);
    Route::delete('/qurban/{id_qurban}', [QurbanController::class,'deleteQurban']); 
    Route::post('/saldo-kas', [KasController::class, 'createKas']);
    Route::put('/saldo-kas/{id_kas}', [KasController::class,'updateKas']);
    Route::delete('/saldo-kas/{id_kas}', [KasController::class,'deleteKas']);
});

Route::get('/qurban', [QurbanController::class,'readQurban']);
Route::get('/saldo-kas', [KasController::class, 'readAllKas']);


