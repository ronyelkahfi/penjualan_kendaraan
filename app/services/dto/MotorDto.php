<?php 
namespace App\Services\Dto;

use App\Services\Dto\KendaraanDto;
class MotorDto extends KendaraanDto{
    public string $mesin; 
    public string $tipeSuspensi;
    public string $tipeTransmisi;
    function __construct(string $nama, int $tahunKeluaran, string $warna, float $harga, string $mesin, string $tipeSuspensi, string $tipeTransmisi){
        parent::__construct($nama, $tahunKeluaran, $warna, $harga);
        $this->mesin = $mesin;
        $this->tipeSuspensi = $tipeSuspensi;
        $this->tipeTransmisi = $tipeTransmisi;
    }
}