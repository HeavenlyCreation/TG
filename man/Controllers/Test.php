<?php
namespace Man\Controllers;


class Test{
    function __construct()
    {
    }

    public function aa($a){
//        \Twig_Autoloader::register();

        $loader = new \Twig_Loader_Filesystem(BASEDIR.'/Man/Views');//echo BASEDIR.'/Man/Views';
        $twig = new \Twig_Environment($loader, array(
            // 'cache' => BASEDIR.'/Man/Cache',
            'cache' => false,
        ));

<<<<<<< HEAD
//        echo $twig->render('/Layouts/test.tg', array('the' => $a, 'go' => 'here'));
//        $twig->display('/Layouts/test.tg', array('the' => $a, 'go' => 'here'));
=======
        // echo $twig->render('/Layouts/test.tg', array('the' => $a, 'go' => 'here'));
        $twig->display('/Layouts/test.twig', array('the' => $a, 'go' => 'here'));
>>>>>>> origin/master
    }
}