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
        if($result){
            return $this->responseUtil->response(201, "Created", $result);
        }
    }

    function getSalesByProduct(){
        $result = $this->penjualanService->getSalesByProduct();
        return $this->responseUtil->response(200,"Get data success", $result);
    }
}
