<?php
namespace App\Services\Dto;
class CustomerDto{
    public string $nama;
    public string $alamat;
    public string $telepon;
    function __construct(string $nama, string $alamat, string $telepon){
        $this->nama = $nama;
        $this->alamat = $alamat;
        $this->telepon = $telepon;
    }
}