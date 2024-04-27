<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Saldo_kas;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class KasController extends Controller
{
    public function createKas(Request $request){
        $status = '';
        $message = '';
        $data = '';
        $status_code = 200;
        try{
            $newKas = Saldo_kas::create([
                'total_saldo' => $request->total_saldo,
                'tanggal' => Carbon::now()->format('Y-m-d'),
                'kas_jenis_id'=> $request->kas_jenis_id,
            ]);
            if($newKas){
                $message = 'inputan data saldo kas berhasil dibuat';
                $status_code = 200;
    
            }else{
                $message = 'inputan data saldo kas gagal';
                $status_code = 400;
            }
            $status = 'success';
            $data = $newKas;

        }catch(\Exception $e){
            $status = 'failed';
            $message = 'Gagal menjalankan requesst'. $e->getMessage();
            $status_code = 500;
        }finally{
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $data
            ], $status_code);

        }
    }

    public function readAllKas(Request $request){
        $status = '';
        $message = '';
        $data = '';
        $status_code = 200;
        try{
            $allKas = Saldo_kas::all();
            if(!is_null($allKas) && $allKas->isNotEmpty()){
                $message = 'data saldo kas berhasil didapat';
                $status_code = 200;
    
            }else{
                $message = 'data kas tidak tersedia';
                $status_code = 404;
            }
            $status = 'success';
            $data = $allKas;

        }catch(\Exception $e){
            $status = 'failed';
            $message = 'Gagal menjalankan requesst'. $e->getMessage();
            $status_code = 500;
        }finally{
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $data
            ], $status_code);

        }
    }

    public function updateKas(Request $request, $id_kas){
        $status = '';
        $message = '';
        $data = '';
        $status_code = 200;
        try{
            $kas = Saldo_kas::find($id_kas);
            if($kas){
                $kas->update([
                    'total_saldo' => $request->total_saldo ?? $kas->total_saldo,
                    'tanggal' => Carbon::now()->format('Y-m-d'),
                    'kas_jenis_id' => $request->kas_jenis_id ?? $kas->kas_jenis_id,
                ]);
                $message = 'saldo kas berhasil diperbarui';
                $status_code = 200;
            }else{
                $message = 'Data saldo kas tidak ditemukan';
                $status_code = 404;
            }
            $status = 'success';
            $data = $kas;
    
        }catch(\Exception $e){
            $status = 'failed';
            $message = 'Gagal menjalankan request: ' . $e->getMessage();
            $status_code = 500;
        }finally{
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $data
            ], $status_code);
        }
    }
    
}
