<?php
namespace Man\Controllers;


class Test{
    function __construct()
    {
    }

    public function aa($a){
//        \Twig_Autoloader::register();

        $loader = new \Twig_Loader_Filesystem('F:/GitHub/TG/Man/Views');
        $twig = new \Twig_Environment($loader, array(
            'cache' => 'F:/GitHub/TG/Man/Cache',
        ));

//        echo $twig->render('/Layouts/test.tg', array('the' => $a, 'go' => 'here'));
//        $twig->display('/Layouts/test.tg', array('the' => $a, 'go' => 'here'));
    }
}