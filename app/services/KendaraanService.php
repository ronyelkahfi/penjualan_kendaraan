<?php
namespace App\Services;
use App\Repositories\KendaraanRepository;
use App\Services\Dto\MobilDto;
use App\Services\Dto\MotorDto;
class KendaraanService {
    protected $kendaraanRepo;
    
    function __construct(KendaraanRepository $kendaraanRepo){
        $this->kendaraanRepo = $kendaraanRepo;
    }

    function create($data){
        if($data->jenis_kendaraan=="motor"){
            $input = new MotorDto(
                $data->tahun,
                $data->warna,
                $data->harga, 
                $data->mesin,
                $data->tipe_suspensi,
                $data->tipe_transmisi 
            );
        }elseif($data->jenis_kendaraan=="mobil"){
            $input = new MobilDto(
                $data->tahun,
                $data->warna,
                $data->harga,
                $data->mesin,
                $data->kapasitas_penumpang,
                $data->tipe
            );
        }
        
        $inputData = (array) $input;
        $inputData["stok"] = $data->stok;
        // // var_dump($inputData);
        $result = $this->kendaraanRepo->create($inputData);
        return $this->response(201,"Created",$result);
    }
    function getStok(){
        $result = $this->kendaraanRepo->get();
        return $this->response(200, "Success", $result);
    }
    function response(int $code, string $message, $data){
        return response(json_encode([
            "status" => $code,
            "message" => $message,
            "data" => $data
        ]), $code)
        ->header('Content-Type', 'text/json');
    }
    function responseError(int $code){
        return response(json_encode([
            "status" => $code,
            "message" => $message
        ]), $code)
        ->header('Content-Type', 'text/json');
    }
}