<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\LaporanKeuangan;
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
            'saldo_masuk' => 'required|integer',
            'tanggal' => 'required|string',
            'saldo_keluar' => 'required|integer',
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

            $newKas = LaporanKeuangan::create([
                'judul' => $validatedData['judul'],
                'saldo_masuk' => $validatedData['saldo_masuk'],
                'tanggal' => $validatedData['tanggal'],
                'saldo_keluar' => $validatedData['saldo_keluar'],
                'total_saldo' => $validatedData['total_saldo'],
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
