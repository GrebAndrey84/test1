<?php
namespace frontend\components;

use yii\base\Widget;
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 18.02.2020
 * Time: 23:03
 */
class appleWidget extends Widget
{
    public $id;
//    public $status;
//    public $condition;
//    public $size;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->render('appleForm',['id'=>$this->id]);
    }

}