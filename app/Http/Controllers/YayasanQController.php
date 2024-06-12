<?php

namespace App\Http\Controllers;

use App\Models\YayasanQurban;
use Illuminate\Http\Request;

class YayasanQController extends Controller
{
    public function createYayasan(Request $request){
        $status = '';
        $message = '';
        $data = '';
        $status_code = 200;

        try {

            $imagePath = null;
            if ($request->hasFile('gambar_surat')) {
                $file = $request->file('gambar_surat');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $path = public_path('images');

                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }

                $file->move($path, $filename);

                $imagePath = 'images/' . $filename;
            }

            $newQurban = YayasanQurban::create([
                'nama_yayasan' => $request->nama_yayasan,
                'tanggal' => $request->tanggal,
                'gambar_surat' => $imagePath,
                'rekapan_sapi' => $request->rekapan_sapi,
                'rekapan_kambing' => $request->rekapan_kambing
            ]);

            if ($newQurban) {
                $message = 'Inputan data yayasan penerima qurban berhasil dilakukan';
                $status_code = 200;
            } else {
                $message = 'Inputan data yayasan penerima qurban gagal';
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

    public function readAllYayasan(){
        $status = '';
        $message = '';
        $data = '';
        $status_code = 200;
        try {
            $allYayasan = YayasanQurban::all();
            if (!is_null($allYayasan) && $allYayasan->isNotEmpty()) {
                $message = 'Data yayasan penerima qurban berhasil didapat';
                $status_code = 200;
            } else {
                $message = 'Data yayasan penerima qurban tidak tersedia';
                $status_code = 404;
            }
            $status = 'success';
            $data = $allYayasan;
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

    public function readByIdYayasan($id){
        $status = '';
        $message = '';
        $data = '';
        $status_code = 200;

        try {
            $yayasan = YayasanQurban::find($id);
            if ($yayasan) {
                $message = 'Data yayasan penerima qurban berhasil didapat';
                $status_code = 200;
                $status = 'success';
                $data = $yayasan;
            } else {
                $message = 'Data yayasan penerima qurban tidak ditemukan';
                $status_code = 404;
                $status = 'error';
            }
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

    public function updateYayasan(Request $request, $id){
        $status = '';
        $message = '';
        $data = '';
        $status_code = 200;

        try {
            $yayasan = YayasanQurban::find($id);
            if ($yayasan) {
                $imagePath = $yayasan->gambar_surat;
                if ($request->hasFile('gambar_surat')) {
                    $file = $request->file('gambar_surat');
                    $filename = time() . '.' . $file->getClientOriginalExtension();
                    $path = public_path('images');

                    if (!file_exists($path)) {
                        mkdir($path, 0755, true);
                    }

                    $file->move($path, $filename);

                    // Hapus gambar lama jika ada
                    if ($imagePath && file_exists(public_path($imagePath))) {
                        unlink(public_path($imagePath));
                    }

                    $imagePath = 'images/' . $filename;
                }

                $yayasan->update([
                    'nama_yayasan' => $request->nama_yayasan ?? $yayasan->nama_yayasan,
                    'tanggal' => $request->tanggal ?? $yayasan->tanggal,
                    'gambar_surat' => $imagePath ?? $yayasan->gambar_surat,
                    'rekapan_sapi' => $request->rekapan_sapi ?? $yayasan->rekapan_sapi,
                    'rekapan_kambing' => $request->rekapan_kambing ?? $yayasan->rekapan_kambing
                ]);

                $message = 'Data yayasan penerima qurban berhasil diperbarui';
                $status = 'success';
                $data = $yayasan;
                $status_code = 200;
            } else {
                $message = 'Data yayasan penerima qurban tidak ditemukan';
                $status = 'error';
                $status_code = 404;
            }
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

    public function deleteYayasan($id){
        $status = '';
        $message = '';
        $data = '';
        $status_code = 200;

        try {
            $yayasan = YayasanQurban::find($id);
            if ($yayasan) {
                $imagePath = $yayasan->gambar_surat;
                $yayasan->delete();

                // Hapus gambar jika ada
                if ($imagePath && file_exists(public_path($imagePath))) {
                    unlink(public_path($imagePath));
                }

                $message = 'Data yayasan penerima qurban berhasil dihapus';
                $status = 'success';
                $status_code = 200;
            } else {
                $message = 'Data yayasan penerima qurban tidak ditemukan';
                $status = 'error';
                $status_code = 404;
            }
        } catch (\Exception $e) {
            $status = 'failed';
            $message = 'Gagal menjalankan request: ' . $e->getMessage();
            $status_code = 500;
        } finally {
            return response()->json([
                'status' => $status,
                'message' => $message
            ], $status_code);
        }
    }
}
