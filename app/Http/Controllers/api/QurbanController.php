<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Qurban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QurbanController extends Controller
{
    public function deleteQurban($id_qurban)
    {
        $status = '';
        $message = '';
        $status_code = 200;
        try {
            $qurban = Qurban::find($id_qurban);
            if (!$qurban) {
                $message = 'Data qurban tidak ditemukan';
                $status_code = 404;
            } else {
                $qurban->delete();
                $status = 'success';
                $message = 'Data qurban berhasil dihapus';
                $status_code = 200;
            }
        } catch (\Exception $e) {
            $status = 'failed';
            $message = 'Gagal menghapus data qurban: ' . $e->getMessage();
            $status_code = 500;
        } finally {
            return response()->json([
                'status' => $status,
                'message' => $message,
            ], $status_code);
        }
    }
    public function readQurban()
    {
        $status = '';
        $message = '';
        $data = '';
        $status_code = 200;
        try {
            $qurban = Qurban::all();
            if ($qurban->isEmpty()) {
                $message = 'Data qurban tidak ditemukan';
                $status_code = 404;
            } else {
                $status = 'success';
                $message = 'Data qurban berhasil ditemukan';
                $data = $qurban;
                $status_code = 200;
            }
        } catch (\Exception $e) {
            $status = 'failed';
            $message = 'Gagal membaca data qurban: ' . $e->getMessage();
            $status_code = 500;
        } finally {
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $data
            ], $status_code);
        }
    }

    public function updateQurban(Request $request, $id_qurban)
    {
        $status = '';
        $message = '';
        $data = '';
        $status_code = 200;
    
        try {
            $qurban = Qurban::find($id_qurban);
    
            if ($qurban) {
                if ($request->hasFile('dokumentasi')) {
                    if ($qurban->dokumentasi) {
                        Storage::disk('public')->delete($qurban->dokumentasi);
                    }
                    $dokumentasi = $request->file('dokumentasi')->store('images', 'public');
                } else {
                    $dokumentasi = $qurban->dokumentasi;
                }
    
                // Perbarui data qurban
                $updatedQurban = $qurban->update([
                    'nama_orang_berqurban' => $request->nama_orang_berqurban ?? $qurban->nama_orang_berqurban,
                    'tanggal' => $request->tanggal ?? $qurban->tanggal,
                    'dokumentasi' => $dokumentasi,
                    'deskripsi' => $request->deskripsi ?? $qurban->deskripsi,
                    'qurban_jenis_id' => $request->qurban_jenis_id ?? $qurban->qurban_jenis_id
                ]);
    
                if ($updatedQurban) {
                    $status = 'success';
                    $message = 'Data Qurban berhasil diubah.';
                    $data = $updatedQurban;
                } else {
                    $status = 'failed';
                    $message = 'Data Qurban gagal diubah.';
                    $status_code = 400;
                }
            } else {
                $status = 'failed';
                $status_code = 404;
                $message = 'Data Qurban tidak ditemukan.';
            }
        } catch (\Exception $e) {
            $status = 'failed';
            $message = 'Gagal menjalankan request. ' . $e->getMessage();
            $status_code = $e->getCode();
        } finally {
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $data
            ], $status_code);
        }
    }
    
    



    public function createQurban(Request $request)
    {
        $status = '';
        $message = '';
        $data = '';
        $status_code = 200;
    
        try {
            // Simpan gambar
            $imagePath = null;
            if ($request->hasFile('dokumentasi')) {
                $imagePath = $request->file('dokumentasi')->store('images', 'public');
            }
    
            // Buat data qurban
            $newQurban = Qurban::create([
                'nama_orang_berqurban' => $request->nama_orang_berqurban,
                'tanggal' => $request->tanggal,
                'dokumentasi' => $imagePath, // Simpan jalur gambar dalam basis data
                'deskripsi' => $request->deskripsi,
                'qurban_jenis_id' => $request->qurban_jenis_id
            ]);
    
            if ($newQurban) {
                $message = 'Inputan data qurban berhasil dilakukan';
                $status_code = 200;
            } else {
                $message = 'Inputan data qurban gagal';
                $status_code = 400;
            }
            $status = 'success';
            $data = $newQurban;
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
