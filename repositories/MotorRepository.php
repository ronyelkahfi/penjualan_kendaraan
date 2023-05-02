<?php
namespace App\Repositories;
use App\Repositories\KendaraanRepository;
class MotorRepository extends KendaraanRepository{
    protected string $mesin; 
    protected string $tipeSuspensi;
    protected string $tipeTransmisi;
    function __construct(int $tahunKeluaran, string $warna, float $harga, string $mesin, string $tipeSuspensi, string $tipeTransmisi){
        parent::__construct($tahunKeluaran, $warna, $harga);
        $this->mesin = $mesin;
        $this->tipeSuspensi = $tipeSuspensi;
        $this->tipeTransmisi = $tipeTransmisi;
    }
    
}