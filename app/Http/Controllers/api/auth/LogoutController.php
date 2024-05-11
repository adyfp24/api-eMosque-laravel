<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
 * @OA\Post(
 *     path="/api/logout",
 *     summary="User logout",
 *     description="Logout to revoke access token.",
 *     operationId="logout",
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="Successful logout",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="success", description="Status of the response"),
 *             @OA\Property(property="message", type="string", example="Logout successful", description="Message indicating the status of the logout")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="error", description="Status of the response"),
 *             @OA\Property(property="message", type="string", example="Unauthorized", description="Message indicating the status of the logout")
 *         )
 *     )
 * )
 */
    public function logout(){
        try{
            $user = auth()->user();
            $deleteToken = $user->tokens()->delete();
            if($deleteToken){
                $message = 'Anda telah berhasil logout';
                $status_code = 200;
            }else{
                $message = 'logout gagal';
                $status_code = 400;
            }
            $status = 'success';
        }catch(\Exception $e){
            $status = 'failed';
            $message = 'Gagal menjalankan request' . $e->getMessage() ;
            $status_code = 500;
        }finally{
            return response()->json([
                'status' => $status,
                'message' => $message,
            ], $status_code);
        }
    }
}
