<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ZakatFitrah;
use Exception;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class ZakatController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/zakat-fitrah",
     *     summary="Create new Zakat data",
     *     description="Create new Zakat data.",
     *     operationId="createZakat",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nama_pezakat", type="string", example="John Doe", description="Name of the zakat giver"),
     *             @OA\Property(property="jumlah_zakat", type="integer", example=100000, description="Amount of zakat"),
     *             @OA\Property(property="zakat_jenis_id", type="integer", example=1, description="ID of the zakat type")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful creation of Zakat data",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Data Zakat Berhasil Ditambahkan", description="Message indicating the status of the data creation"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="failed", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Gagal menjalankan request.", description="Message indicating the status of the data creation failure"),
     *             @OA\Property(property="data", type="object", description="Additional error data")
     *         )
     *     )
     * )
     */
    public function createZakat(Request $request){
        $status= '' ;
        $message= '';
        $data = '';
        $status_code = 200;
        try{
            $newZakat = ZakatFitrah::create([
                'nama_pezakat' => $request->nama_pezakat,
                'jumlah_zakat' => $request->jumlah_zakat,
                'zakat_jenis_id' => $request->zakat_jenis_id
            ]);
            if ($newZakat){
                $message = 'Data Zakat Berhasil Ditambahkan';
                $status_code= 200;
            }else{
                $message = 'Data Zakat Gagal Ditambahkan';
                $status_code =500;
            }
            $status='success';
            $data = $newZakat;
        }catch(\Exception $e){
            $status='Failed';
            $message='Gagal Menjalankan Request' . $e->getMessage();
            $status_code = 500;
        }finally{
            return response()->json([
                'status'=> $status,
                'message'=> $message,
                'data'=> $data
            ], $status_code);
        }

    }

    /**
     * @OA\Get(
     *     path="/api/zakat-fitrah",
     *     summary="Read Zakat data",
     *     description="Read Zakat data.",
     *     operationId="readZakat",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful retrieval of Zakat data",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Data Berhasil ditemukan", description="Message indicating the status of the data retrieval"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Zakat data not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Data Zakat Tidak ditemukan", description="Message indicating the status of the data retrieval failure"),
     *             @OA\Property(property="data", type="object", description="Additional error data")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="failed", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Gagal Menajalankan Request", description="Message indicating the status of the data retrieval failure"),
     *             @OA\Property(property="data", type="object", description="Additional error data")
     *         )
     *     )
     * )
     */


    public function readZakat(Request $request){
        $status = '';
        $message = '';
        $data = '';
        $status_code = 200;
        try{
            $readzakat = ZakatFitrah::all();
            if($readzakat->isEmpty()){
                $message = "Data Zakat Tidak ditemukan";
                $status_code = 404;
            }else{
                $message = "Data Berhasil ditemukan";     
                $status_code = 200;
            }
            $status = "success";
            $data = $readzakat;
        }catch(\Exception $e){
            $status = "failed";
            $message = "Gagal Menajalankan Request: ". $e->getMessage();
            $status_code = 500;

        }finally{
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $data,

            ],$status_code);

        }
    }

    /**
     * @OA\Put(
     *     path="/api/zakat-fitrah/{id_zakatfitrah}",
     *     summary="Update existing Zakat data",
     *     description="Update existing Zakat data.",
     *     operationId="updateZakat",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id_zakatfitrah",
     *         in="path",
     *         required=true,
     *         description="ID of the Zakat data to be updated",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nama_pezakat", type="string", example="John Doe", description="Name of the zakat giver"),
     *             @OA\Property(property="jumlah_zakat", type="integer", example=100000, description="Amount of zakat"),
     *             @OA\Property(property="zakat_jenis_id", type="integer", example=1, description="ID of the zakat type")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful update of Zakat data",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Data Zakat Berhasil Diperbaharui", description="Message indicating the status of the data update"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Zakat data not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Data Tidak Ditemukan", description="Message indicating the status of the data update failure"),
     *             @OA\Property(property="data", type="object", description="Additional error data")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="failed", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Gagal Menjalankan Request", description="Message indicating the status of the data update failure"),
     *             @OA\Property(property="data", type="object", description="Additional error data")
     *         )
     *     )
     * )
     */

    public function updateZakat(Request $request, $id_zakatfitrah){
        $status = '';
        $message = '';
        $data = '';
        $status_code = '';

        try{
            $updateZakat = ZakatFitrah::find($id_zakatfitrah);
            if($updateZakat){
                $updateZakat->update([
                    'nama_pezakat' => $request->nama_pezakat ?? $updateZakat->nama_pezakat,
                    'jumlah_zakat' => $request->jumlah_zakat ?? $updateZakat->jumlah_zakat,
                    'zakat_jenis_id' => $request->zakat_jenis_id ?? $updateZakat->zakat_jenis_id,
                ]);
                $message = 'Data Zakat Berhasil Diperbaharui';
                $status_code = 200;
            }else{
                $message = 'Data Gagal Diperbaharui';
                $status_code = 500;
            }
            $status = "success";
            $data = $updateZakat;

        }catch(\Exception $e){
            $status = 'failed';
            $message = 'Gagal Menjalankan Requset'. $e->getMessage();
            $status_code = 500;
        }finally{
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $data,
                
            ],$status_code);

        }
    }

    /**
     * @OA\Delete(
     *     path="/api/zakat-fitrah/{id_zakatfitrah}",
     *     summary="Delete Zakat data",
     *     description="Delete Zakat data.",
     *     operationId="deleteZakat",
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *         name="id_zakatfitrah",
     *         in="path",
     *         required=true,
     *         description="ID of the Zakat data to be deleted",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful deletion of Zakat data",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Data Zakat Berhasil Dihapus", description="Message indicating the status of the data deletion"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Zakat data not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Data Tidak Ditemukan", description="Message indicating the status of the data deletion failure"),
     *             @OA\Property(property="data", type="object", description="Additional error data")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="failed", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Gagal Menjalankan Request", description="Message indicating the status of the data deletion failure"),
     *             @OA\Property(property="data", type="object", description="Additional error data")
     *         )
     *     )
     * )
     */

    public function deleteZakat(Request $request, $id_zakatfitrah){
        $status = '';
        $message = '';
        $data = '';
        $status_code = '';

        try{
            $deleteZakat = ZakatFitrah::find($id_zakatfitrah);
            if($deleteZakat){
                $deleteZakat->delete();
                $message = 'Data Zakat Berhasil Dihapus';
                $status_code = 200;
            }else{
                $message = 'Data Tidak Ditemukan';
                $status_code = 404;
            }
            $status = "success";
            $data = $deleteZakat;
            $status_code = 200;

        }catch(\Exception $e){
            $status = "failed";
            $message = "Gagal Menjalankan Request: ". $e->getMessage();
            $status_code = 500;
        }finally{
            return response()->json([
                'status'=> $status,
                'message'=> $message,
                'data'=> $data,
                
            ], $status_code);
        }
    }
}
