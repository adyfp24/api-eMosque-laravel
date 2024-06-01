<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegistController extends Controller
{
/**
 * @OA\Post(
 *     path="/api/register",
 *     summary="Register a new user",
 *     description="Register a new user with the provided name, email, password, and role ID.",
 *     operationId="register",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name","email","password","role_id"},
 *             @OA\Property(property="name", type="string", example="John Doe", description="User's name"),
 *             @OA\Property(property="email", type="string", format="email", example="john@example.com", description="User's email address"),
 *             @OA\Property(property="password", type="string", format="password", example="password", description="User's password"),
 *             @OA\Property(property="role_id", type="integer", example=1, description="ID of user's role")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Successful registration",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="success", description="Status of the response"),
 *             @OA\Property(property="message", type="string", example="Registration successful", description="Message indicating the status of the registration"),
 *             @OA\Property(property="data", type="object", description="User data")
 *         )
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Invalid input",
 *         @OA\JsonContent(
 *             @OA\Property(property="status", type="string", example="error", description="Status of the response"),
 *             @OA\Property(property="message", type="string", example="Registration failed", description="Message indicating the status of the registration"),
 *             @OA\Property(property="data", type="object", description="Additional error data")
 *         )
 *     )
 * )
 */

 public function register(Request $request)
 {
     $status = '';
     $message = '';
     $data = '';
     $status_code = 201;
 
     try {

         $validatedData = $request->validate([
             'name' => 'required|string|unique:users',
             'email' => 'required|string|email|unique:users',
             'password' => 'required|string',
             'role_id' => 'required|integer'
         ]);
 
         $newUser = User::create([
             'name' => $validatedData['name'],
             'email' => $validatedData['email'],
             'password' => bcrypt($validatedData['password']),
             'role_id' => $validatedData['role_id']
         ]);
 
         if ($newUser) {
             $status = 'success';
             $message = 'registrasi telah berhasil dilakukan';
             $data = $newUser;
             $status_code = 201;
         } else {
             $status = 'failed';
             $message = 'registrasi gagal';
             $status_code = 400;
         }
     } catch (\Illuminate\Validation\ValidationException $e) {
         
         $status = 'failed';
         $message = 'Validasi gagal: ' . implode(", ", $e->errors());
         $status_code = 422;
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
