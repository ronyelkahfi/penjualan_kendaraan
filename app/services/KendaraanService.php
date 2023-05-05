<?php
namespace App\Services;
use App\Repositories\KendaraanRepository;
use App\Services\Dto\MobilDto;
use App\Services\Dto\MotorDto;
use Illuminate\Support\Facades\Validator;
class KendaraanService {
    protected $kendaraanRepo;
    
    function __construct(KendaraanRepository $kendaraanRepo){
        $this->kendaraanRepo = $kendaraanRepo;
    }

    function create($data){
        if(empty($data->jenis_kendaraan)){
            return [
                "success"=> false,
                "code"=> 500,
                "message"=> "Bad request",
                "constraint" => ["undefine jenis_kendaraan"]
            ];
        }
        if($data->jenis_kendaraan=="motor"){
            $rules = [
                'nama' => ['required', 'string', 'max:255'],
                'tahun' => ['required', 'integer','max:2100',],
                'warna' => ['required', 'string', 'max:20'],
                'harga' => ['required', 'integer', 'max:10000000'],
                'mesin' => ['required', 'string', 'max:50'],
                'tipe_suspensi' => ['required', 'string', 'max:50'],
                'tipe_transmisi' => ['required', 'string', 'max:50'],
                'stok' => ['required', 'integer', 'max:100000'],
            ];
            $validator = Validator::make((array) $data, $rules);
            if($validator->fails()){
                $messages = $validator->errors();
                return [
                    "success"=> false,
                    "code" => 400,
                    "message" => "Bad request",
                    "constraint" => $messages
                ];
            }
            $input = new MotorDto(
                $data->nama,
                $data->tahun,
                $data->warna,
                $data->harga, 
                $data->mesin,
                $data->tipe_suspensi,
                $data->tipe_transmisi 
            );
        }elseif($data->jenis_kendaraan=="mobil"){
            $rules = [
                'nama' => ['required', 'string', 'max:255'],
                'tahun' => ['required', 'integer','max:2100',],
                'warna' => ['required', 'string', 'max:20'],
                'harga' => ['required', 'integer', 'max:10000000000'],
                'mesin' => ['required', 'string', 'max:50'],
                'kapasitas_penumpang' => ['required', 'integer', 'max:200'],
                'tipe' => ['required', 'string', 'max:50'],
                'stok' => ['required', 'integer', 'max:100000'],
            ];
            $validator = Validator::make((array) $data, $rules);
            if($validator->fails()){
                $messages = $validator->errors();
                return [
                    "success"=> false,
                    "code" => 400,
                    "message" => "Bad request",
                    "constraint" => $messages
                ];
            }
            $input = new MobilDto(
                $data->nama,
                $data->tahun,
                $data->warna,
                $data->harga,
                $data->mesin,
                $data->kapasitas_penumpang,
                $data->tipe
            );
        }else{
            return [
                "success"=> false,
                "code"=> 500,
                "message"=> "Bad request",
                "constraint" => [`use jenis_kendaraan=motor or mobil`]
            ];
        }
        
        $inputData = (array) $input;
        $inputData["stok"] = $data->stok;
        
        $result = $this->kendaraanRepo->create($inputData);        
        if($result){
            return [
                "success"=>true,
                "code"=>201,
                "message"=>"Created",
                "data"=>$result
            ];
        }else{
            return [
                "success"=>false,
                "code"=>500,
                "message"=>"System Error",
                "constraint"=>["Problem database"]
            ];
        }
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