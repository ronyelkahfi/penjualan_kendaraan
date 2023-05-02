<?php
namespace App\Repositories;
use App\models\Kendaraan;
class KendaraanRepository{
    protected int $tahunKeluaran;
    protected string $warna;
    protected float $harga;
    function __construct(int $tahunKeluaran, string $warna, float $harga){
        $this->tahunKeluaran = $tahunKeluaran;
        $this->warna = $warna;
        $this->harga = $harga;
    }
    
    function create($data){
        return Kendaraan::create($data);
    }
    
    function getById(string $id){
        return Kendaraan::find($id);
    }

    function get(){
        return Kendaraan::all();
    }

    function update(string $id, $data){
        return Kendaraan::where('id', $id)->update($data);
    }
    function delete(string $id){
        $kendaraan = Kendaraan::find($id);
        return $kendaraan->delete();
    }   
}