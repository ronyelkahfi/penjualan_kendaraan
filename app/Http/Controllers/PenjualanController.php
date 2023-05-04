<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PenjualanService;
class PenjualanController extends Controller
{
    protected $penjualanService;
    
    function __construct(PenjualanService $penjualanService){
        $this->penjualanService = $penjualanService;
    }

    function create(Request $req){
        $data = json_decode($req->getContent());
        $result = $this->penjualanService->create($data);
        if($result){
            return $this->response(201, "Created", $result);
        }
    }

    function getSalesByProduct(){
        $result = $this->penjualanService->getSalesByProduct();
        return $this->response(200,"Get data success", $result);
    }
    
    function response(int $code, string $message, $data){
        return response(json_encode([
            "status" => $code,
            "message" => $message,
            "data" => $data
        ]), $code)
        ->header('Content-Type', 'text/json');
        return $this->response(201,"Created",$result);
    }
    
    function responseError(int $code, string $message){
        return response(json_encode([
            "status" => $code,
            "message" => $message
        ]), $code)
        ->header('Content-Type', 'text/json');
    }
}
