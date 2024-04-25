<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegistController extends Controller
{
    public function register(Request $request){
        $status = '';
        $message = '';
        $data = '';
        $status_code = '';
        try{
            $newUser = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role_id' => $request->role_id
            ]);
            if($newUser){
                $message = 'registrasi telah berhasil dilakukan';
                $status_code = 201;
            }else{
                $message = 'registrasi gagal';
                $status_code = 400;
            }
            $status = 'success';
            $data = $newUser;
        }catch(\Exception $e){
            $status = 'failed';
            $message = 'Gagal menjalankan request' . $e->getMessage() ;
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
