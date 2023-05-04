<?php 
namespace App\repositories;
use App\Models\Penjualan;
use Illuminate\Support\Facades\DB;
class PenjualanRepository{
    protected $penjualan;
    function __construct(Penjualan $penjualan){
        $this->penjualan = $penjualan;
    }
    function create($data){
        return $this->penjualan->create($data);
    }
    function getSalesByProduct(){
        $result = $this->penjualan->raw(function($collection){
            return $collection->aggregate([
                [
                    '$unwind' => '$items'
                ],
                [
                    '$group' => [
                        '_id' => '$items.id',
                        'totalQty' => ['$sum' => '$items.qty']
                    ]
                ],
            ]);
        });      
        return $result;
    }
}