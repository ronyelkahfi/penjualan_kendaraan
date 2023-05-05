<?php
namespace App\Services\Dto;
use App\Services\Dto\KendaraanDto;
class MobilDto extends KendaraanDto{
    public string $mesin;
    public int $kapasitas_penumpang;
    public string $tipe;
    function __construct(string $nama, int $tahunKeluaran, string $warna, float $harga, string $mesin, int $kapasitasPenumpang, string $tipe){
        parent::__construct($nama, $tahunKeluaran, $warna, $harga);
        $this->mesin = $mesin;
        $this->kapasitasPenumpang = $kapasitasPenumpang;
        $this->tipe = $tipe;
    }

}