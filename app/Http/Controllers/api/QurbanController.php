<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Qurban;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QurbanController extends Controller
{
    /**
     * @OA\Delete(
     *     path="/api/qurban/{id_qurban}",
     *     summary="Delete existing Qurban data",
     *     description="Delete existing Qurban data.",
     *     operationId="deleteQurban",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id_qurban",
     *         in="path",
     *         required=true,
     *         description="ID of the qurban data to be deleted",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful deletion of Qurban data",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Data qurban berhasil dihapus", description="Message indicating the status of the data deletion"),
     *             @OA\Property(property="data", type="object", description="Additional data")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Qurban data not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Data qurban tidak ditemukan", description="Message indicating the status of the data deletion failure"),
     *             @OA\Property(property="data", type="object", description="Additional error data")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="failed", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Gagal menghapus data qurban", description="Message indicating the status of the data deletion failure"),
     *             @OA\Property(property="data", type="object", description="Additional error data")
     *         )
     *     )
     * )
     */
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
    /**
     * @OA\Get(
     *     path="/api/qurban",
     *     summary="Read all Qurban data",
     *     description="Retrieve all Qurban data.",
     *     operationId="readQurban",
     *     @OA\Response(
     *         response=200,
     *         description="Successful retrieval of Qurban data",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Data qurban berhasil ditemukan", description="Message indicating the status of the data retrieval"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Qurban data not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Data qurban tidak ditemukan", description="Message indicating the status of the data retrieval failure"),
     *             @OA\Property(property="data", type="object", description="Additional error data")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="failed", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Gagal membaca data qurban", description="Message indicating the status of the data retrieval failure"),
     *             @OA\Property(property="data", type="object", description="Additional error data")
     *         )
     *     )
     * )
     */
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
    /**
     * @OA\Put(
     *     path="/api/qurban/{id_qurban}",
     *     summary="Update existing Qurban data",
     *     description="Update existing Qurban data.",
     *     operationId="updateQurban",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id_qurban",
     *         in="path",
     *         required=true,
     *         description="ID of the qurban data to be updated",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nama_orang_berqurban", type="string", example="John Doe", description="Name of the person performing the qurban"),
     *             @OA\Property(property="tanggal", type="string", format="date", example="2024-07-25", description="Date of the qurban"),
     *             @OA\Property(property="dokumentasi", type="string", format="binary", example="base64 encoded image data", description="Image documentation of the qurban"),
     *             @OA\Property(property="deskripsi", type="string", example="Description of the qurban", description="Description of the qurban activity"),
     *             @OA\Property(property="qurban_jenis_id", type="integer", example=1, description="ID of the qurban type")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful update of Qurban data",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Data Qurban berhasil diubah.", description="Message indicating the status of the data update"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Data Qurban gagal diubah.", description="Message indicating the status of the data update failure"),
     *             @OA\Property(property="data", type="object", description="Additional error data")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Qurban data not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Data Qurban tidak ditemukan.", description="Message indicating the status of the data update failure"),
     *             @OA\Property(property="data", type="object", description="Additional error data")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="failed", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Gagal menjalankan request.", description="Message indicating the status of the data update failure"),
     *             @OA\Property(property="data", type="object", description="Additional error data")
     *         )
     *     )
     * )
     */
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
    
     /**
     * @OA\Post(
     *     path="/api/qurban",
     *     summary="Create new Qurban data",
     *     description="Create new Qurban data.",
     *     operationId="createQurban",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nama_orang_berqurban","tanggal","dokumentasi","deskripsi","qurban_jenis_id"},
     *             @OA\Property(property="nama_orang_berqurban", type="string", example="John Doe", description="Name of the person performing the qurban"),
     *             @OA\Property(property="tanggal", type="string", format="date", example="2024-07-25", description="Date of the qurban"),
     *             @OA\Property(property="dokumentasi", type="string", format="binary", example="base64 encoded image data", description="Image documentation of the qurban"),
     *             @OA\Property(property="deskripsi", type="string", example="Description of the qurban", description="Description of the qurban activity"),
     *             @OA\Property(property="qurban_jenis_id", type="integer", example=1, description="ID of the qurban type")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful creation of Qurban data",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Inputan data qurban berhasil dilakukan", description="Message indicating the status of the data creation"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Inputan data qurban gagal", description="Message indicating the status of the data creation failure"),
     *             @OA\Property(property="data", type="object", description="Additional error data")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="failed", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Gagal menjalankan request", description="Message indicating the status of the data creation failure"),
     *             @OA\Property(property="data", type="object", description="Additional error data")
     *         )
     *     )
     * )
     */
    public function createQurban(Request $request)
    {
        $status = '';
        $message = '';
        $data = '';
        $status_code = 200;
    
        try {
            
            $imagePath = null;
            if ($request->hasFile('dokumentasi')) {
                $imagePath = $request->file('dokumentasi')->store('images', 'public');
            }
    
            $newQurban = Qurban::create([
                'nama_orang_berqurban' => $request->nama_orang_berqurban,
                'tanggal' => $request->tanggal,
                'dokumentasi' => $imagePath,
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
