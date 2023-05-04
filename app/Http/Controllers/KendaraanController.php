<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\KendaraanService;
use App\Utils\ResponseUtil;
class KendaraanController extends Controller
{
    protected $kendaraanService;
    protected $responseUtil;
    function __construct(KendaraanService $kendaraanService, ResponseUtil $response){
        $this->kendaraanService = $kendaraanService;
        $this->responseUtil = $response;
    }
    function create(Request $req){
        $data = json_decode($req->getContent());
        // var_dump($data);
        $result = $this->kendaraanService->create($data);
        return $this->responseUtil->response(201,"Created",$result);
    }
    function get(){
        $result = $this->kendaraanService->getStok();
        return $this->responseUtil->response(200, "Success", $result);
    }
    function response(int $code, string $message, $data){
        return response(json_encode([
            "status" => $code,
            "message" => $message,
            "data" => $data
        ]), $code)
        ->header('Content-Type', 'text/json');
        return $this->responseUtil->response(201,"Created",$result);
    }
    
}
