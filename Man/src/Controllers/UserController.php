<?php
/**
 * Created by IntelliJ IDEA.
 * User: WangJ
 * Date: 2016/7/10
 * Time: 15:12
 */

namespace Man\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends BaseController
{
    public function indexAction(Request $request){
//        return new Response('Yep');
        return $this->tpl->render('Layout/Main.twig', array('the' => 'variables', 'go' => 'here'));
    }

    public function GetInfo($id){
        return 'abc+'.$id;
    }
    
    public function GetInfos(){
        return "Allaa";
    }
}