<?php
namespace App\Services\Dto;
class PenjualanDto{
    public string $no_nota;
    public $customer;
    public $items = [];

    function __construct(string $noNota, $customer){
        $this->no_nota = $noNota;
        $this->customer = $customer;

    }

    function addItems($kendaraan, int $qty){
        array_push($this->items, [
            "id" => $kendaraan->_id,
            "harga" => $kendaraan->harga,
            "qty"=> $qty
        ]);
    }
    
    function get(){
        return [
            "no_nota" => $this->no_nota,
            "customer" => $this->customer,
            "items" => $this->items
        ];
    }
}