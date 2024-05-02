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

    public function updateKegiatan(Request $request, $id_kegiatan)
    {
        $status = '';
        $message = '';
        $data = '';
        $status_code = 200;
        try {
            $kegiatan = DetailKegiatan::find($id_kegiatan);
            if ($kegiatan) {
                $updatedKegiatan = $kegiatan->update([
                    'kegiatan_id' => $request->id_kegiatan ?? $kegiatan->kegiatan_id,
                    'nama_pengaju' => $request->nama_pengaju ?? $kegiatan->nama_pengaju,
                    'deskripsi' => $request->deskripsi ?? $kegiatan->deskripsi,
                    'tgl_kegiatan' => $request->tgl_kegiatan ?? $kegiatan->tgl_kegiatan,
                    'pj_id' => $request->id_pj ?? $kegiatan->pj_id
                ]);
                $message = 'berhasil memperbarui data kegiatan';
                $status_code = 200;
            } else {
                $message = 'id kegiatan tidak ditemukan';
                $status_code = 404;
            }
            $status = 'success';
            $data = $updatedKegiatan;
        } catch (\Exception $e) {
            $status = 'ailed';
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

    public function deleteKegiatan($id_kegiatan){
        $status = '';
        $message = '';
        $data = '';
        $status_code = 200;
        try {
            $kegiatan = DetailKegiatan::find($id_kegiatan);
            if ($kegiatan) {
                $kegiatan->delete();
                $message = 'kegiatan berhasil dihapus';
                $status_code = 200;
            } else {
                $message = 'Data kegiatan tidak ditemukan';
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
