<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request){
        try{
            $user = User::where('name', $request->name)->first();
            if(!$user){
                $message = 'username tidak terdaftar';
                $status_code = 401;
            }
            $passwordCheck = Hash::check($request->password, $user->password);
            if(!$passwordCheck){
                $message = 'registrasi telah berhasil dilakukan';
                $status_code = 401;
            }
            $api_token = $user->createToken('api_token')->plainTextToken;
            $status = 'success';
            $message = 'login sukses';
            $status_code = 201;
            $data = $user;
        }catch(\Exception $e){
            $status = 'failed';
            $message = 'Gagal menjalankan request'. $e->getMessage() ;
            $status_code = 500;
        }finally{
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $data,
                'acces_token' => $api_token
            ], $status_code);
        }
    }
}
