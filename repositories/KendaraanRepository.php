<?php
namespace App\Repositories;

class KendaraanRepository{
    protected int $tahunKeluaran;
    protected string $warna;
    protected float $harga;
    function __construct(int $tahunKeluaran, string $warna, float $harga){
        $this->tahunKeluaran = $tahunKeluaran;
        $this->warna = $warna;
        $this->harga = $harga;
    }
}