<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\KendaraanService;
class KendaraanController extends Controller
{
    protected $kendaraanService;
    function __construct(KendaraanService $kendaraanService){
        $this->kendaraanService = $kendaraanService;
    }
    function create(Request $req){
        $data = json_decode($req->getContent());
        // var_dump($data);
        $result = $this->kendaraanService->create($data);
        return $this->response(201,"Created",$result);
    }
    function get(){
        $result = $this->kendaraanService->getStok();
        return $this->response(200, "Success", $result);
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
    
}
