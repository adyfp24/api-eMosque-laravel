<?php

namespace App\Http\Controllers;

use App\Models\YayasanZakat;
use Illuminate\Http\Request;

class YayasanZController extends Controller
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


            $newQurban = YayasanZakat::create([
                'nama_yayasan' => $request->nama_yayasan,
                'tanggal' => $request->tanggal,
                'gambar_surat' => $imagePath,
                'rekapan_uang' => $request->rekapan_uang,
                'rekapan_beras' => $request->rekapan_beras
            ]);

            if ($newQurban) {
                $message = 'Inputan data yayasan penerima zakat berhasil dilakukan';
                $status_code = 200;
            } else {
                $message = 'Inputan data yayasan penerima zakat gagal';
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
            $allYayasan = YayasanZakat::all();
            if (!is_null($allYayasan) && $allYayasan->isNotEmpty()) {
                $message = 'data yayasan penerima zakat berhasil didapat';
                $status_code = 200;

            } else {
                $message = 'data yayasan penerima zakat tidak tersedia';
                $status_code = 404;
            }
            $status = 'success';
            $data = $allYayasan;

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
    public function updateYayasan(Request $request, $id){
        $status = '';
        $message = '';
        $data = '';
        $status_code = 200;

        try {
            $yayasan = YayasanZakat::find($id);
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
                    'rekapan_uang' => $request->rekapan_uang ?? $yayasan->rekapan_uang,
                    'rekapan_beras' => $request->rekapan_beras ?? $yayasan->rekapan_beras
                ]);

                $message = 'Data yayasan penerima zakat berhasil diperbarui';
                $status = 'success';
                $data = $yayasan;
                $status_code = 200;
            } else {
                $message = 'Data yayasan penerima zakat tidak ditemukan';
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
            $yayasan = YayasanZakat::find($id);
            if ($yayasan) {
                $imagePath = $yayasan->gambar_surat;
                $yayasan->delete();

                // Hapus gambar jika ada
                if ($imagePath && file_exists(public_path($imagePath))) {
                    unlink(public_path($imagePath));
                }

                $message = 'Data yayasan penerima zakat berhasil dihapus';
                $status = 'success';
                $status_code = 200;
            } else {
                $message = 'Data yayasan penerima zakat tidak ditemukan';
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
