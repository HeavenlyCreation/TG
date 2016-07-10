<?php
/**
 * Created by IntelliJ IDEA.
 * User: WangJ
 * Date: 2016/7/10
 * Time: 14:40
 */

return $FastRoute = [

    'Man' => [
        ['GET', '/user/getinfo/{param:\d+}', 'UserController.GetInfo'],
    ]

];