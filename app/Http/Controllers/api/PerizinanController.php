<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\DetailPerizinan;
use Illuminate\Http\Request;

class PerizinanController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/perizinan",
     *     summary="Create a new perizinan",
     *     description="Create a new perizinan with the provided details.",
     *     operationId="createPerizinan",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"id_perizinan", "nama_pengaju", "deskripsi", "tgl_kegiatan", "id_pj"},
     *             @OA\Property(property="id_perizinan", type="integer", example=1, description="ID of the perizinan"),
     *             @OA\Property(property="nama_pengaju", type="string", example="John Doe", description="Name of the pengaju"),
     *             @OA\Property(property="deskripsi", type="string", example="Deskripsi perizinan", description="Description of the perizinan"),
     *             @OA\Property(property="tgl_kegiatan", type="string", format="date", example="2022-05-25", description="Date of the perizinan"),
     *             @OA\Property(property="id_pj", type="integer", example=1, description="ID of the PJ")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful creation of perizinan",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="berhasil menambah data perizinan", description="Message indicating the status of the perizinan creation"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="gagal menambah data perizinan", description="Message indicating the status of the perizinan creation failure"),
     *             @OA\Property(property="data", type="object", description="Additional error data")
     *         )
     *     )
     * )
     */
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

    /**
     * @OA\Put(
     *     path="/api/perizinan/{id_perizinan}",
     *     summary="Update perizinan",
     *     description="Update perizinan data by ID.",
     *     operationId="updatePerizinan",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id_perizinan",
     *         in="path",
     *         description="ID of the perizinan to be updated",
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
     *             @OA\Property(property="deskripsi", type="string", example="Deskripsi perizinan", description="Description of the perizinan"),
     *             @OA\Property(property="tgl_kegiatan", type="string", format="date", example="2022-05-25", description="Date of the perizinan"),
     *             @OA\Property(property="id_pj", type="integer", example=1, description="ID of the PJ")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful update of perizinan",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="berhasil memperbarui data perizinan", description="Message indicating the status of the perizinan update"),
     *             @OA\Property(property="data", type="object", description="Updated perizinan data")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Perizinan data not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="id perizinan tidak ditemukan", description="Message indicating the status of the perizinan update failure")
     *         )
     *     )
     * )
     */
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

    /**
     * @OA\Delete(
     *     path="/api/perizinan/{id_perizinan}",
     *     summary="Delete perizinan",
     *     description="Delete perizinan data by ID.",
     *     operationId="deletePerizinan",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id_perizinan",
     *         in="path",
     *         description="ID of the perizinan to be deleted",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful deletion of perizinan",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="perizinan berhasil dihapus", description="Message indicating the status of the perizinan deletion")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Perizinan data not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Data perizinan tidak ditemukan", description="Message indicating the status of the perizinan deletion failure")
     *         )
     *     )
     * )
     */
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

    public function readAllPerizinan(){
        $status = '';
        $message = '';
        $data = '';
        $status_code = 200;
        try {
            $allPerizinan = DetailPerizinan::join('perizinans', 'detail_perizinans.perizinan_id', '=', 'perizinans.id_perizinan')
            ->join('penanggung_jawabs', 'detail_perizinans.pj_id', '=', 'penanggung_jawabs.id_pj')
            ->select('detail_perizinans.*', 'perizinans.nama_perizinan', 'penanggung_jawabs.nama_pj')
            ->get();
            if (!is_null($allPerizinan) && $allPerizinan->isNotEmpty()) {
                $message = 'data perizinan berhasil didapat';
                $status_code = 200;

            } else {
                $message = 'data perizinan tidak tersedia';
                $status_code = 404;
            }
            $status = 'success';
            $data = $allPerizinan;

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
}
