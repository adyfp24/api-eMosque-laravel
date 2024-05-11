<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\DetailKegiatan;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class KegiatanController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/kegiatan",
     *     summary="Create a new kegiatan",
     *     description="Create a new kegiatan with the provided details.",
     *     operationId="createKegiatan",
     *     security={{"sanctum": {}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"id_kegiatan", "nama_pengaju", "deskripsi", "tgl_kegiatan", "id_pj"},
     *             @OA\Property(property="id_kegiatan", type="integer", example=1, description="ID of the kegiatan"),
     *             @OA\Property(property="nama_pengaju", type="string", example="John Doe", description="Name of the pengaju"),
     *             @OA\Property(property="deskripsi", type="string", example="Deskripsi kegiatan", description="Description of the kegiatan"),
     *             @OA\Property(property="tgl_kegiatan", type="string", format="date", example="2022-05-25", description="Date of the kegiatan"),
     *             @OA\Property(property="id_pj", type="integer", example=1, description="ID of the PJ")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful creation of kegiatan",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="berhasil menambah data kegiatan", description="Message indicating the status of the kegiatan creation"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="gagal menambah data kegiatan", description="Message indicating the status of the kegiatan creation failure"),
     *             @OA\Property(property="data", type="object", description="Additional error data")
     *         )
     *     )
     * )
     */
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

    /**
     * @OA\Put(
     *     path="/api/kegiatan/{id_kegiatan}",
     *     summary="Update kegiatan",
     *     description="Update kegiatan data by ID.",
     *     operationId="updateKegiatan",
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="id_kegiatan",
     *         in="path",
     *         description="ID of the kegiatan to be updated",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nama_pengaju", "deskripsi", "tgl_kegiatan", "id_pj"},
     *             @OA\Property(property="nama_pengaju", type="string", example="John Doe", description="Name of the pengaju"),
     *             @OA\Property(property="deskripsi", type="string", example="Deskripsi kegiatan", description="Description of the kegiatan"),
     *             @OA\Property(property="tgl_kegiatan", type="string", format="date", example="2022-05-25", description="Date of the kegiatan"),
     *             @OA\Property(property="id_pj", type="integer", example=1, description="ID of the PJ")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful update of kegiatan",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="berhasil memperbarui data kegiatan", description="Message indicating the status of the kegiatan update"),
     *             @OA\Property(property="data", type="object", description="Updated kegiatan data")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Kegiatan data not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="id kegiatan tidak ditemukan", description="Message indicating the status of the kegiatan update failure")
     *         )
     *     )
     * )
     */


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


    /**
     * @OA\Delete(
     *     path="/api/kegiatan/{id_kegiatan}",
     *     summary="Delete kegiatan",
     *     description="Delete kegiatan data by ID.",
     *     operationId="deleteKegiatan",
     *     security={{"sanctum": {}}},
     *     @OA\Parameter(
     *         name="id_kegiatan",
     *         in="path",
     *         description="ID of the kegiatan to be deleted",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful deletion of kegiatan",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="kegiatan berhasil dihapus", description="Message indicating the status of the kegiatan deletion"),
     *             @OA\Property(property="data", type="null", description="No data returned")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Kegiatan data not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Data kegiatan tidak ditemukan", description="Message indicating the status of the kegiatan deletion failure")
     *         )
     *     )
     * )
     */

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
