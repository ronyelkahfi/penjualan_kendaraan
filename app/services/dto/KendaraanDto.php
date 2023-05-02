<?php
namespace App\Services\Dto;
class KendaraanDto{
    public int $tahunKeluaran;
    public string $warna;
    public float $harga;

    function __construct(int $tahunKeluaran, string $warna, float $harga){
        $this->tahunKeluaran = $tahunKeluaran;
        $this->warna = $warna;
        $this->harga = $harga;
    }
}
