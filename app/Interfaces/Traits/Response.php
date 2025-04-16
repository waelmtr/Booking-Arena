<?php
namespace App\Interfaces\Traits;

use Symfony\Component\HttpFoundation\Response as Res;

trait Response {
    public function success($data , $message = 'success'){
        return response()->json([
            "status" => true ,
            "data" => $data ,
            "message" => $message ,
        ] , 200); 
    }

    public function error($message = 'error' , $statusCode){
        if(!array_key_exists($statusCode , Res::$statusTexts)) $statusCode = 500;
        return response()->json([
            "status" => false ,
            "message" => $message ,
        ] , $statusCode);
    }
}