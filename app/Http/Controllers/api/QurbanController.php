<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Qurban;
use Illuminate\Http\Request;

class QurbanController extends Controller
{   
    public function deleteQurban($id_qurban){
        $status = '';
        $message = '';
        $status_code = '';
        try{
            $qurban = Qurban::find($id_qurban);
            if(!$qurban){
                $message = 'Data qurban tidak ditemukan';
                $status_code = 404;
            }else{
            $qurban->delete();
            $status = 'success';
            $message = 'Data qurban berhasil dihapus';
            $status_code = 200;
            }
    
        }catch(\Exception $e){
            $status = 'failed';
            $message = 'Gagal menghapus data qurban: ' . $e->getMessage();
            $status_code = 500;
        }finally{
            return response()->json([
                'status' => $status,
                'message' => $message,
            ], $status_code);
        }
    }
    public function readQurban(){
        $status = '';
        $message = '';
        $data = '';
        $status_code = '';
        try{
            $qurban = Qurban::all();
            if($qurban->isEmpty()){
                $message = 'Data qurban tidak ditemukan';
                $status_code = 404; 
            } else {
                $status = 'success';
                $message = 'Data qurban berhasil ditemukan';
                $data = $qurban;
                $status_code = 200;
            }
    
        }catch(\Exception $e){
            $status = 'failed';
            $message = 'Gagal membaca data qurban: ' . $e->getMessage();
            $status_code = 500;
        }finally{
            return response()->json([
                'status' => $status,
                'message' => $message,
                'data' => $data
            ], $status_code);
        }
    }
    
    
    public function createQurban(Request $request){
        $status = '';
        $message = '';
        $data = '';
        $status_code = '';
        try{
            $newQurban = Qurban::create([
                'nama_orang_berqurban' => $request->nama_orang_berqurban,
                'tanggal'=> $request->tanggal,
                'dokumentasi'=> $request->dokumentasi,
                'deskripsi'=> $request->deskripsi,
                'qurban_jenis_id'=>$request->qurban_jenis_id
            ]);
            if($newQurban){
                $message = 'inputan data qurban berhasil dilakukan';
                $status_code = 200;
    
            }else{
                $message = 'inputan data querban gagal';
                $status_code = 400;
            }
            $status = 'success';
            $data = $newQurban;

        }catch(\Exception $e){
            $status = 'failde';
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
