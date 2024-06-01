<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/profile",
     *     summary="Get user profile",
     *     description="Retrieve the profile data of the authenticated user.",
     *     operationId="getProfile",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Successful retrieval of user profile",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="data user berhasil didapatkan", description="Message indicating the status of the profile retrieval"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="User data not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="data user tidak tersedia", description="Message indicating the status of the profile retrieval failure"),
     *             @OA\Property(property="data", type="object", description="Additional error data")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="failed", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Gagal menjalankan requesst", description="Message indicating the status of the profile retrieval failure"),
     *             @OA\Property(property="data", type="object", description="Additional error data")
     *         )
     *     )
     * )
     */
    public function getProfile(){
        $status = '';
        $message = '';
        $data = '';
        $status_code = 200;
        try{
            $user = auth()->user();
            if($user){
                $profileData = $user->join('roles', 'users.role_id', '=', 'roles.id_role')
                ->select('users.*', 'roles.nama_role')
                ->get();
                $message = 'data user berhasil didapatkan';
                $status_code = 200;

            }else{
                $message = 'data user tidak tersedia';
                $status_code = 404;
            }
            $status = 'success';
            $data = $profileData;
        }catch(\Exception $e){
            $status = 'failed';
            $message = 'Gagal menjalankan requesst'. $e->getMessage();
            $status_code = 500;
        }finally{
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $data
            ], $status_code);

        }
    }
}
