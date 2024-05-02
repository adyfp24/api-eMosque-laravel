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

    public function updatePerizinan(Request $request, $id_perizinan)
    {
        $status = '';
        $message = '';
        $data = '';
        $status_code = 200;
        try {
            $perizinan = DetailPerizinan::find($id_perizinan);
            if ($perizinan) {
                $updatedPerizinan = $perizinan->update([
                    'perizinan_id' => $request->id_perizinan ?? $perizinan->perizinan_id,
                    'nama_pengaju' => $request->nama_pengaju ?? $perizinan->nama_pengaju,
                    'deskripsi' => $request->deskripsi ?? $perizinan->deskripsi,
                    'tgl_kegiatan' => $request->tgl_kegiatan ?? $perizinan->tgl_kegiatan,
                    'pj_id' => $request->id_pj ?? $perizinan->id_pj
                ]);
                $message = 'berhasil memperbarui data perizinan';
                $status_code = 200;
            } else {
                $message = 'id perizinan tidak ditemukan';
                $status_code = 404;
            }
            $status = 'success';
            $data = $updatedPerizinan;
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

    public function deletePerizinan($id_perizinan){
        $status = '';
        $message = '';
        $data = '';
        $status_code = 200;
        try {
            $perizinan = DetailPerizinan::find($id_perizinan);
            if ($perizinan) {
                $perizinan->delete();
                $message = 'perizinan berhasil dihapus';
                $status_code = 200;
            } else {
                $message = 'Data perizinan tidak ditemukan';
                $status_code = 404;
            }
            $status = 'success';
        } catch (\Exception $e) {
            $status = 'failed';
            $message = 'Gagal menjalankan request: ' . $e->getMessage();
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
