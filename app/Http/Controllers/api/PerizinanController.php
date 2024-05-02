<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\DetailPerizinan;
use Illuminate\Http\Request;

class PerizinanController extends Controller
{
    public function createPerizinan(Request $request)
    {
        $status = '';
        $message = '';
        $data = '';
        $status_code = 200;
        try {
            $newPerizinan = DetailPerizinan::create([
                'perizinan_id' => $request->id_perizinan,
                'nama_pengaju' => $request->nama_pengaju,
                'deskripsi' => $request->deskripsi,
                'tgl_kegiatan' => $request->tgl_kegiatan,
                'pj_id' => $request->id_pj
            ]);
            if ($newPerizinan) {
                $message = 'berhasil menambah data perizinan';
                $status_code = 200;

            } else {
                $message = 'gagal menambah data perizinan';
                $status_code = 400;
            }
            $status = 'success';
            $data = $newPerizinan;

        } catch (\Exception $e) {
            $status = 'failed';
            $message = 'Gagal menjalankan request' . $e->getMessage();
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
