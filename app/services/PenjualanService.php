<?php
namespace App\Services;
use App\Services\Dto\PenjualanDto;
use App\Services\Dto\CustomerDto;
use App\Repositories\PenjualanRepository;
use App\Services\kendaraanService;
class PenjualanService{
    protected $penjualanRepo;
    protected $kendaraanService;
    
    function __construct(PenjualanRepository $penjualanRepo, KendaraanService $kendaraanService){
        $this->penjualanRepo = $penjualanRepo;
        $this->kendaraanService = $kendaraanService;
    }
    
    function create($data){
        $customer = new CustomerDto(
            $data->customer->nama,
            $data->customer->alamat,
            $data->customer->telepon
        );
        $penjualan = new PenjualanDto(
            "no_nota",
            $customer
        );
        foreach($data->items as $item){
            $detailItem = $this->kendaraanService->getDetail($item->id);
            $this->kendaraanService->reduceStok($item->id,$item->qty);
            $penjualan->addItems($detailItem, $item->qty);
        }
        
        return $this->penjualanRepo->create((array)$penjualan);
    }

    function getSalesByProduct(){
        $saleProducts = $this->penjualanRepo->getSalesByProduct();
        $productIds   = [];
        $productSales = [];
        foreach($saleProducts as $product){
            $productIds[] = $product->_id;
            $productSales[$product->_id] = ["total_penjualan" => $product->totalQty];
        }

        $dataProducts = $this->kendaraanService->getDetailByIds($productIds);
        $output = [];
        foreach($dataProducts as $dataProduct){
            $dataRow = (array) $dataProduct;
            
            $productSales[$dataProduct->_id] = array_merge($dataRow, $productSales[$dataProduct->_id]);
        }
        // var_dump($productSales);
        // return $productSales;
    }
}