<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function createLaporan(Request $request)
    {
        $status = '';
        $message = '';
        $data = '';
        $status_code = 200;

        $validator = \Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'total_saldo' => 'required|integer',
            'deskripsi' => 'nullable|string',
        ]);
  
        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $validatedData = $validator->validated();

            $newKas = Transaksi::create([
                'judul' => $validatedData['judul'],
                'nominal' => $validatedData['nominal'],
                'jenis' => $validatedData['jenis'],
                'tanggal' => $validatedData['tanggal'],
                'deskripsi' => $validatedData['deskripsi'],
            ]); 

            if ($newKas) {
                $message = 'Inputan data transaksi berhasil dibuat';
                $status_code = 200;
            } else {
                $message = 'Inputan data transaksi gagal dibuat';
                $status_code = 400;
            }

            $status = 'success';
            $data = $newKas;
        } catch (\Exception $e) {
            $status = 'failed';
            $message = 'Gagal menjalankan request: ' . $e->getMessage();
            $status_code = 500;
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $status_code);
    }
}
