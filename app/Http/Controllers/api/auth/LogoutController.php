<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
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
