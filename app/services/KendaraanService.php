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
        return $this->kendaraanRepo->create($inputData);
        
    }
    function getStok(){
        return $this->kendaraanRepo->get();
    }
    
    function reduceStok(string $kendaraanId,int $reducevalue){
        return $this->kendaraanRepo->reduceStok($kendaraanId,$reducevalue);
    }

    function getDetail(string $id){
        return $this->kendaraanRepo->getById($id);
    }
    function getDetailByIds(Array $ids){
        return $this->kendaraanRepo->getByIds($ids);
    }
}