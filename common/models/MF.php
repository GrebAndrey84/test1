<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 08.02.2020
 * Time: 23:10
 */

namespace common\models;


class MF
{
    public static function db($arr,$stop=false)
    {
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
        if ($stop)
            exit();
    }


}