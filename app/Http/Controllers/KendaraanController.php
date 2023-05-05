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
        
        $result = $this->kendaraanService->create($data);
        if($result["success"]==true){
            return $this->responseUtil->response($result["code"],$result["message"],$result["data"]);
        }else{
            return $this->responseUtil->responseError($result["code"],$result["message"],$result["constraint"]);
        }
    }

    function get(){
        $result = $this->kendaraanService->getStok();
        if($result["success"]==true){
            return $this->responseUtil->response($result["code"],$result["message"],$result["data"]);
        }else{
            return $this->responseUtil->responseError($result["code"],$result["message"],$result["constraint"]);
        }
    }
}
