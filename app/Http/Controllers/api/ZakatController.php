<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ZakatFitrah;
use Exception;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class ZakatController extends Controller
{
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
