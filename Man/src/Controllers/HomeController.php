<?php
/**
 * Created by IntelliJ IDEA.
 * User: WangJ
 * Date: 2016/7/23
 * Time: 16:04
 */

namespace Man\Controllers;


use Man\Models\EOrder;

class HomeController extends BaseController
{
    public function Index(){
        $orders = EOrder::all();
        return $this->tpl->render('Home/Index.twig', ['orders'=>$orders]);
    }
}