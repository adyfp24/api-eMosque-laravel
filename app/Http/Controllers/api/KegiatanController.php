<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\DetailKegiatan;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class KegiatanController extends Controller
{
    public function createKegiatan(Request $request)
    {
        $status = '';
        $message = '';
        $data = '';
        $status_code = 200;
        try {
            $newKegiatan = DetailKegiatan::create([
                'kegiatan_id' => $request->id_kegiatan,
                'nama_pengaju' => $request->nama_pengaju,
                'deskripsi' => $request->deskripsi,
                'tgl_kegiatan' => $request->tgl_kegiatan,
                'pj_id' => $request->id_pj
            ]);
            if ($newKegiatan) {
                $message = 'berhasil menambah data kegiatan';
                $status_code = 200;

            } else {
                $message = 'gagal menambah data kegiatan';
                $status_code = 400;
            }
            $status = 'success';
            $data = $newKegiatan;

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
