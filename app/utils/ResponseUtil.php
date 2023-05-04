<?php
namespace App\Utils;
class ResponseUtil {
    function response(int $code, string $message, $data){
        return response(json_encode([
            "status" => $code,
            "message" => $message,
            "data" => $data
        ]), $code)
        ->header('Content-Type', 'text/json');
        return $this->response(201,"Created",$result);
    }

    function responseError(int $code, string $message, $constraint){
        return response(json_encode([
            "status" => $code,
            "message" => $message,
            "constraint" => $constraint
        ]), $code)
        ->header('Content-Type', 'text/json');
    }
}