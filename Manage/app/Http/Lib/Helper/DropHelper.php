<?php
/**
 * Created by IntelliJ IDEA.
 * User: WangJ
 * Date: 2016/10/15
 * Time: 14:09
 */

namespace App\Http\Lib\Helper;

use App\MCode;
use App\MAddress;
use App\MProductCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Fluent;

class DropHelper
{
    /*
     * 获取产品类别列表
     * @var $CategoryID 类别ID
     */
    public function DropCategory($CategoryID){
        $category = MProductCategory::select("ParentID","ProductCategoryID","CategoryName")
            ->orderby("ParentID","ProductCategoryID")
            ->get();
        $drop = new Fluent([
            "default"=> $CategoryID,
            "data"=> $category
        ]);
        return $drop;
    }

    /*
     * 获取订单状态列表
     * @var $CodeCD MCode表CD
     */
    public function DropStatus($CodeCD){
        $code = MCode::select("CodeCD", "CodeDesc")
            ->where("CodeType", "OrderStatus")
            ->orderby("Sort")
            ->get();
        $drop = new Fluent([
            "default"=> $CodeCD,
            "data"=> $code
        ]);
        return $drop;
    }

    /*
     * 获取产品类别列表
     * @var $AddressCD
     * @var $level0 参数$AddressCD的level
     * @var $level1 需要获取的level
     */
//    public function DropAddress($AddressCD, $level0, $level1){
//        $default = '';
//        $split = 0;
//        if($level0>$level1){    // 提供的$AddressCD级别数大于要获取的级别数，例如$AddressCD是3级的地址，需要获取1级地址
//            $default = substr($AddressCD, 0, $level1*2).str_repeat('0', 6-$level1*2);
//            $split = $level1*2;
//        }else if($level0==$level1){ // 提供的$AddressCD级别数等于要获取的级别数，例如$AddressCD是2级的地址，需要获取2级地址
//            $default = $AddressCD;
//            $split = ($level1-1)*2;
//        }else{
//            $default = "";
//            $split = $level0*2;
//        }
//
//        if($level1==1){ // $AddressCD为空时，根据$level1得到对应所有地址
//            $category = MAddress::where("RegionLevel", $level1)
//                ->orderby("AddressCD")
//                ->get();
//        }else{  // $AddressCD不为空时，根据$AddressCD与$level1得到对应所有地址
//            if()
//            $category = MAddress::where("RegionLevel", $level1)
//                ->where("AddressCD", "like", substr($AddressCD, 0, $split)."%")
//                ->orderby("AddressCD")
//                ->get();
//        }
//
//        $drop = new Fluent([
//            "default"=> $default,
//            "data"=> $category
//        ]);
//        return $drop;
//    }



    public function DropAddress($AddressCD, $level){
        $olevel = strlen(rtrim($AddressCD, '0'))/2; // $AddressCD级别
        //$default = '';  // 下拉菜单默认选项
        //$split = 0;     // 除去末尾0之后的字符串长度
        if($olevel>$level){    // 提供的$AddressCD级别数大于要获取的级别数，例如$AddressCD是3级的地址，需要获取1级地址
            $default = substr($AddressCD, 0, $level*2).str_repeat('0', 6-$level*2);
            $split = $level*2;
        }else if($olevel==$level){ // 提供的$AddressCD级别数等于要获取的级别数，例如$AddressCD是2级的地址，需要获取2级地址
            $default = $AddressCD;
            $split = ($level-1)*2;
        }else{
            $default = "";
            $split = $olevel*2;
        }

        if($level==1){
            $address = MAddress::select('AddressCD', 'AddressName')
                ->where("RegionLevel", $level)
                ->orderby("AddressCD")
                ->get();
        }else{
            $address = MAddress::select('AddressCD', 'AddressName')
                ->where("RegionLevel", $level)
                ->where("AddressCD", "like", substr($AddressCD, 0, $split)."%")
                ->orderby("AddressCD")
                ->get();
        }

        // 添加‘请选择’选项
        $entity = new MAddress();
        $entity->AddressCD = '0';
        $entity->AddressName = '-- 请选择 --';
        $address->prepend($entity);

        $drop = new Fluent([
            "default"=> $default,
            "data"=> $address
        ]);
        return $drop;
    }
}