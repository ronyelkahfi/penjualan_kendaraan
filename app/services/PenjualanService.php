<?php
namespace App\Services;
use App\Services\Dto\PenjualanDto;
use App\Services\Dto\CustomerDto;
use App\Repositories\PenjualanRepository;
use App\Services\kendaraanService;
use Illuminate\Support\Facades\Validator;
class PenjualanService{
    protected $penjualanRepo;
    protected $kendaraanService;
    
    function __construct(PenjualanRepository $penjualanRepo, KendaraanService $kendaraanService){
        $this->penjualanRepo = $penjualanRepo;
        $this->kendaraanService = $kendaraanService;
    }
    
    function create($data){
        $rules = [
            "customer"=>"required",
            "no_nota"=>["required", 'unique:penjualan'],
            "items"=>"required"
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
        // validasi customer
        $validator = Validator::make((array) $data->customer, [
            "nama" => "required",
            "alamat" => "required",
            'telepon' => "required"
        ],[
            "nama.required" => "field customer.nama is required",
            "alamat.required" => "field customer.alamat is required",
            'telepon.required' => "field customer.telepon is required"
        ]);
        if($validator->fails()){
            $messages = $validator->errors();
            return [
                "success"=> false,
                "code" => 400,
                "message" => "Bad request",
                "constraint" => $messages
            ];
        }
        $customer = new CustomerDto(
            $data->customer->nama,
            $data->customer->alamat,
            $data->customer->telepon
        );

        $penjualan = new PenjualanDto(
            $data->no_nota,
            $customer
        );
        $arrItemsSell = [];
        foreach($data->items as $index => $item){
            // validasi items
            $validator = Validator::make((array) $item, [
                "id" => "required",
                "qty" => "required",
            ],[
                "id.required" => "field items[".$index."].id is required",
                "qty.required" => "field items[".$index."].qty is required"
            ]);
            if($validator->fails()){
                $messages = $validator->errors();
                return [
                    "success"=> false,
                    "code" => 400,
                    "message" => "Bad request",
                    "constraint" => $messages
                ];
            }
            $detailItem = $this->kendaraanService->getDetail($item->id);
            if(!$detailItem){
                return [
                    "success"=>false,
                    "code"=>400,
                    "message"=>"Bad Request",
                    "constraint"=>["Unknown items.id = ".$item->id]
                ];
            }
            $arrItemsSell[]=[
                "id" => $item->id,
                "qty" => $item->qty
            ];
            
            $penjualan->addItems($detailItem, $item->qty);
        }
        
        $result = $this->penjualanRepo->create((array)$penjualan);
        if($result){
            foreach($arrItemsSell as $row){
                $this->kendaraanService->reduceStok($row["id"],$row["qty"]);
            }
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
                "message"=>"internal Server Error"
            ];
        }
        
    }

    function getSalesByProduct(){
        $saleProducts = $this->penjualanRepo->getSalesByProduct();
        $productIds   = [];
        $productSales = [];
        foreach($saleProducts as $product){
            $productIds[] = $product->_id;
            $productSales[$product->_id] = ["total_penjualan" => $product->totalQty];
        }

        $dataProducts = json_decode($this->kendaraanService->getDetailByIds($productIds));
        $output = [];
        foreach($dataProducts as $dataProduct){
            
            $dataRow = (array) $dataProduct;
            
            $productSales[$dataProduct->_id] = array_merge($dataRow, $productSales[$dataProduct->_id]);
        }
        return [
            "success"=>true,
            "code"=>200,
            "message"=>"Created",
            "data"=> $productSales
        ];
    }
}