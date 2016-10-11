<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MAddress extends Model
{
    //
    protected $table = 'MAddress';
    protected $primaryKey = 'AddressCD';
    public $timestamps = false;

    /*
     * 省
     */
    public function province(){
        return $this->all()->where("RegionLevel", 1);
    }

    /*
     * 市
     * @param $AddressCD,省的AddressCD
     */
    public function city($AddressCD=""){
        if(isset($AddressCD))
            return $this->all()
                ->where("RegionLevel", 2)
                ->where("AddressCD", "like", $AddressCD.substr(0, 2)."%");
        else
            return $this->all()->where("RegionLevel", 2);
    }

    /*
     * 区
     * @param $AddressCD,市的AddressCD
     */
    public function district(){
        if(isset($AddressCD))
            return $this->all()
                ->where("RegionLevel", 3)
                ->where("AddressCD", "like", $AddressCD.substr(0, 4)."%");
        else
            return $this->all()->where("RegionLevel", 3);
    }
}
