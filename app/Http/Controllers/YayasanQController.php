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

    }
    public function readByIdYayasan(){

    }
    public function deleteYayasan(){
        
    }
}
