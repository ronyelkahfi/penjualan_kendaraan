<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PenjualanService;
use App\Utils\ResponseUtil;
class PenjualanController extends Controller
{
    protected $penjualanService;
    protected $responseUtil;
    function __construct(PenjualanService $penjualanService, ResponseUtil $response){
        $this->penjualanService = $penjualanService;
        $this->responseUtil = $response;
    }

    function create(Request $req){
        $data = json_decode($req->getContent());
        $result = $this->penjualanService->create($data);
        if($result["success"]==true){
            return $this->responseUtil->response($result["code"],$result["message"],$result["data"]);
        }else{
            return $this->responseUtil->responseError($result["code"],$result["message"],$result["constraint"]);
        }
    }

    function getSalesByProduct(){
        $result = $this->penjualanService->getSalesByProduct();
        if($result["success"]==true){
            return $this->responseUtil->response($result["code"],$result["message"],$result["data"]);
        }else{
            return $this->responseUtil->responseError($result["code"],$result["message"],$result["constraint"]);
        }
    }
}
