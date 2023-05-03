<?php
namespace App\Repositories;
use App\models\Kendaraan;
class KendaraanRepository{
    protected $kendaraan;
    function __construct(Kendaraan $kendaraan){
        $this->kendaraan = $kendaraan;
    }
    function create($data){
        
        return $this->kendaraan->create($data);
    }
    
    function getById(string $id){
        return $this->kendaraan->find($id);
    }

    function get(){
        return $this->kendaraan->all();
    }

    function update(string $id, $data){
        return $this->kendaraan->where('id', $id)->update($data);
    }
    function delete(string $id){
        $kendaraan = $this->kendaraan->find($id);
        return $kendaraan->delete();
    }   
}