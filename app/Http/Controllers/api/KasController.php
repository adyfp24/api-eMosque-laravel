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
            $status = 'failde';
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
}
