<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function getProfile(){
        $status = '';
        $message = '';
        $data = '';
        $status_code = 200;
        try{
            $user = auth()->user();
            if($user){
                $message = 'data user berhasil didapatkan';
                $status_code = 200;

            }else{
                $message = 'data user tidak tersedia';
                $status_code = 404;
            }
            $status = 'success';
            $data = $user;
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
