<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function createKegiatan(Request $request){
        $status = '';
        $message = '';
        $data = '';
        $status_code = 200;
        try {
            $newKas = Kegiatan::create([
                'nama_keg' => $request->total_saldo,
            ]);
            if ($newKas) {
                $message = 'inputan data saldo kas berhasil dibuat';
                $status_code = 200;

            } else {
                $message = 'inputan data saldo kas gagal';
                $status_code = 400;
            }
            $status = 'success';
            $data = $newKas;

        } catch (\Exception $e) {
            $status = 'failed';
            $message = 'Gagal menjalankan requesst' . $e->getMessage();
            $status_code = 500;
        } finally {
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $data
            ], $status_code);

        }
    }
}
