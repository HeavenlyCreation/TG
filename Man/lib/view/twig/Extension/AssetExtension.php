<?php
/**
 * Created by IntelliJ IDEA.
 * User: Wang
 * Date: 2016/7/19
 * Time: 17:36
 */

namespace Lib\Twig;


class AssetExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('Asset', array($this, 'assetFunction')),
        );
    }

    public function assetFunction($file, $ver)
    {
//        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
//        $price = '$'.$price;
//
//        return $asset;
    }

    public function getName()
    {
        return 'asset_extension';
    }

}