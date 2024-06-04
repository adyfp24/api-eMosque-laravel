<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Saldo_kas;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class KasController extends Controller
{

    /**
     * @OA\Post(
     *     path="/api/saldo-kas",
     *     summary="Create new kas",
     *     description="Create a new kas with total saldo, kas jenis ID, and current date.",
     *     operationId="createKas",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"total_saldo","kas_jenis_id"},
     *             @OA\Property(property="total_saldo", type="number", example=1000000, description="Total saldo of the kas"),
     *             @OA\Property(property="kas_jenis_id", type="integer", example=1, description="ID of the kas jenis")
     *             @OA\Property(property="kas_jenis_id", type="integer", example=1, description="ID of the kas jenis")
     *             @OA\Property(property="kas_jenis_id", type="integer", example=1, description="ID of the kas jenis")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful creation of kas",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Inputan data saldo kas berhasil dibuat", description="Message indicating the status of the kas creation"),
     *             @OA\Property(property="data", type="object", description="Created kas data")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Inputan data saldo kas gagal", description="Message indicating the status of the kas creation failure"),
     *             @OA\Property(property="data", type="object", description="Additional error data")
     *         )
     *     )
     * )
     */



     public function createKas(Request $request)
     {
         $status = '';
         $message = '';
         $data = '';
         $status_code = 200;
     
         $validator = \Validator::make($request->all(), [
             'judul' => 'required|string|max:255',
             'nominal' => 'required|integer|min:0',
             'jenis' => 'required|in:pemasukan,pengeluaran',
             'tanggal' => 'required|date',
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
     

    /**
     * @OA\Get(
     *     path="/api/saldo-kas",
     *     summary="Read all kas",
     *     description="Read all kas data.",
     *     operationId="readAllKas",
     *     @OA\Response(
     *         response=200,
     *         description="Successful retrieval of kas data",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Data saldo kas berhasil didapat", description="Message indicating the status of the kas retrieval"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No kas data available",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Data kas tidak tersedia", description="Message indicating the status of the kas retrieval failure")
     *         )
     *     )
     * )
     */


    public function readAllKas(Request $request)
    {
        $status = '';
        $message = '';
        $data = '';
        $status_code = 200;
        try {
            $allKas = Transaksi::all();
            if (!is_null($allKas) && $allKas->isNotEmpty()) {
                $message = 'data saldo kas berhasil didapat';
                $status_code = 200;

            } else {
                $message = 'data kas tidak tersedia';
                $status_code = 404;
            }
            $status = 'success';
            $data = $allKas;

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

    /**
     * @OA\Put(
     *     path="/api/saldo-kas/{id_kas}",
     *     summary="Update kas",
     *     description="Update kas data by ID.",
     *     operationId="updateKas",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id_kas",
     *         in="path",
     *         description="ID of the kas to be updated",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="total_saldo", type="number", example=2000000, description="Updated total saldo of the kas"),
     *             @OA\Property(property="kas_jenis_id", type="integer", example=2, description="Updated ID of the kas jenis")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful update of kas",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Saldo kas berhasil diperbarui", description="Message indicating the status of the kas update"),
     *             @OA\Property(property="data", type="object", description="Updated kas data")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Kas data not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Data saldo kas tidak ditemukan", description="Message indicating the status of the kas update failure")
     *         )
     *     )
     * )
     */

    public function updateKas(Request $request, $id_kas)
    {
        $status = '';
        $message = '';
        $data = '';
        $status_code = 200;
        try {
            $kas = Saldo_kas::find($id_kas);
            if ($kas) {
                $kas->update([
                    'total_saldo' => $request->total_saldo ?? $kas->total_saldo,
                    'tanggal' => Carbon::now()->format('Y-m-d'),
                    'kas_jenis_id' => $request->kas_jenis_id ?? $kas->kas_jenis_id,
                ]);
                $message = 'saldo kas berhasil diperbarui';
                $status_code = 200;
            } else {
                $message = 'Data saldo kas tidak ditemukan';
                $status_code = 404;
            }
            $status = 'success';
            $data = $kas;

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

    /**
     * @OA\Delete(
     *     path="/api/saldo-kas/{id_kas}",
     *     summary="Delete kas",
     *     description="Delete kas data by ID.",
     *     operationId="deleteKas",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id_kas",
     *         in="path",
     *         description="ID of the kas to be deleted",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful deletion of kas",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Saldo kas berhasil dihapus", description="Message indicating the status of the kas deletion"),
     *             @OA\Property(property="data", type="null", description="No data returned")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Kas data not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Data saldo kas tidak ditemukan", description="Message indicating the status of the kas deletion failure")
     *         )
     *     )
     * )
     */

    public function deleteKas($id_kas)
    {
        $status = '';
        $message = '';
        $data = '';
        $status_code = 200;
        try {
            $kas = Saldo_kas::find($id_kas);
            if ($kas) {
                $kas->delete();
                $message = 'saldo kas berhasil dihapus';
                $status_code = 200;
            } else {
                $message = 'Data saldo kas tidak ditemukan';
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

    /**
     * @OA\Get(
     *     path="/api/saldo-kas/{id_kas}/approve",
     *     summary="Approve kas",
     *     description="Approve kas data by ID.",
     *     operationId="approveKas",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id_kas",
     *         in="path",
     *         description="ID of the kas to be approved",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="approval",
     *         in="query",
     *         description="Approval status ('true' for approve, 'false' for disapprove)",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *             enum={"true", "false"}
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful approval of kas",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Saldo kas berhasil disetujui", description="Message indicating the status of the kas approval"),
     *             @OA\Property(property="data", type="object", description="Approved kas data")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Kas data not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Data saldo kas tidak ditemukan", description="Message indicating the status of the kas approval failure")
     *         )
     *     )
     * )
     */



    public function approveKas(Request $request, $id_kas)
    {
        $status = '';
        $message = '';
        $data = '';
        $status_code = 200;

        try {
            $kas = Saldo_kas::find($id_kas);

            if ($kas) {
                $approval = $request->query('approval');

                if ($approval === 'true') {
                    $kas->approval = true;
                    $message = 'Saldo kas berhasil disetujui';
                } elseif ($approval === 'false') {
                    $kas->approval = false;
                    $message = 'Saldo kas tidak disetujui';
                } else {
                    return response()->json([
                        'status' => 'failed',
                        'message' => 'Query parameter "approval" harus bernilai "true" atau "false".',
                        'data' => null
                    ], 400);
                }
                $kas->save();
                $status_code = 200;
            } else {
                $message = 'Data saldo kas tidak ditemukan';
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
