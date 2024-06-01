<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="User login",
     *     description="Login with username and password to obtain access token.",
     *     operationId="login",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","password"},
     *             @OA\Property(property="name", type="string", example="john_doe", description="User's username"),
     *             @OA\Property(property="password", type="string", format="password", example="password", description="User's password")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful login",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Login successful", description="Message indicating the status of the login"),
     *             @OA\Property(property="data", type="object", description="User data")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error", description="Status of the response"),
     *             @OA\Property(property="message", type="string", example="Unauthorized", description="Message indicating the status of the login")
     *         )
     *     )
     * )
     */
    public function login(Request $request)
    {
        try {
            // Validasi request input
            $request->validate([
                'name' => 'required|string',
                'password' => 'required|string',
            ]);

            // Cari pengguna berdasarkan nama
            $user = User::where('name', $request->name)->first();

            if (!$user) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'username tidak terdaftar',
                ], 401);
            }

            // Periksa kecocokan password
            if (!Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => 'failed',
                    'message' => 'password salah',
                ], 401);
            }

            // Buat token API
            $api_token = $user->createToken('api_token')->plainTextToken;

            // Respon sukses
            return response()->json([
                'status' => 'success',
                'message' => 'login sukses',
                'data' => $user,
                'access_token' => $api_token
            ], 201);
        } catch (\Exception $e) {
            // Tangani kesalahan
            return response()->json([
                'status' => 'failed',
                'message' => 'Gagal menjalankan request: ' . $e->getMessage(),
            ], 500);
        }
    }

}
