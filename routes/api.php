<?php

use App\Http\Controllers\api\auth\LogoutController;
use App\Http\Controllers\api\KasController;
use App\Http\Controllers\api\KegiatanController;
use App\Http\Controllers\api\PerizinanController;
use App\Http\Controllers\api\ProfileController;
use App\Http\Controllers\api\QurbanController;
use App\Http\Controllers\api\auth\LoginController;
use App\Http\Controllers\api\auth\RegistController;
use App\Http\Controllers\api\ZakatController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\YayasanQController;
use App\Models\ZakatFitrah;
use App\Models\DetailKegiatan;
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


Route::get('/coba', function () {
    return response()->json(['test' => 'test ini brow'], 200);
});

Route::post('/register', [RegistController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [ProfileController::class, 'getProfile']);
    Route::post('/logout', [LogoutController::class, 'logout']);

    Route::post('/zakat-fitrah', [ZakatController::class,'createZakat']);
    Route::put('/zakat-fitrah/{id_zakatfitrah}', [ZakatController::class,'updateZakat']);
    Route::delete('/zakat-fitrah/{id_zakatfitrah}', [ZakatController::class,'deleteZakat']);
});

Route::get('/zakat-fitrah', [ZakatController::class,'readZakat']);
Route::get('/qurban', [QurbanController::class, 'readQurban']);
Route::get('/saldo-kas', [KasController::class, 'readAllKas']);
Route::get('/perizinan', [PerizinanController::class, 'readAllPerizinan']);

Route::middleware(['auth:sanctum', 'role:ketua'])->group(function () {
    Route::post('/saldo-kas/{id_kas}/', [KasController::class, 'approveKas']);
});

Route::middleware(['auth:sanctum', 'role:bendahara'])->group(function () {
    Route::post('/saldo-kas', [KasController::class, 'createKas']);
    Route::put('/saldo-kas/{id_kas}', [KasController::class, 'updateKas']);
    Route::delete('/saldo-kas/{id_kas}', [KasController::class, 'deleteKas']);
});

Route::middleware(['auth:sanctum', 'role:sekretaris'])->group(function () {
    Route::put('/qurban/{id_qurban}', [QurbanController::class, 'updateQurban']);
    Route::post('/qurban', [QurbanController::class, 'createQurban']);
    Route::delete('/qurban/{id_qurban}', [QurbanController::class, 'deleteQurban']);

    Route::post('/perizinan', [PerizinanController::class, 'createPerizinan']);
    Route::put('/perizinan/{id_perizinan}', [PerizinanController::class, 'updatePerizinan']);
    Route::delete('/perizinan/{id_perizinan}', [PerizinanController::class, 'deletePerizinan']);

    Route::post('/kegiatan', [KegiatanController::class, 'createKegiatan']);
    Route::put('/kegiatan/{id_kegiatan}', [KegiatanController::class, 'updateKegiatan']);
    Route::delete('/kegiatan/{id_kegiatan}', [KegiatanController::class, 'deleteKegiatan']);

    Route::post('/yayasan-qurban', [YayasanQController::class, 'createYayasan']);
});

Route::get('/product', [ProductController::class, 'getProduct']);