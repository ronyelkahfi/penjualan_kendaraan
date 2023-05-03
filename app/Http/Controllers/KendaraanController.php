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
        return $this->kendaraanService->create($data);
    }
    function get(){
        return $this->kendaraanService->getStok();
    }
}
