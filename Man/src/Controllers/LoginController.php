<?php
/**
 * Created by IntelliJ IDEA.
 * User: WangJ
 * Date: 2016/7/23
 * Time: 11:13
 */

namespace Man\Controllers;

use Symfony\Component\HttpFoundation\Request;


class LoginController extends BaseController
{
    public function index(){
        return $this->tpl->render('Login/Index.twig');
    }
}