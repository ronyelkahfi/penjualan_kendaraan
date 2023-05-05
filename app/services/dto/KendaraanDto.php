<?php
namespace App\Services\Dto;
class KendaraanDto{
    public int $tahunKeluaran;
    public string $warna;
    public float $harga;

    function __construct(string $nama, int $tahunKeluaran, string $warna, float $harga){
        $this->tahunKeluaran = $tahunKeluaran;
        $this->warna = $warna;
        $this->harga = $harga;
        $this->nama =  $nama;
    }
}
