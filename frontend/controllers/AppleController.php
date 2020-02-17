<?php
/**
 * Created by PhpStorm.
 * User: Andrey
 * Date: 16.02.2020
 * Time: 0:33
 */

namespace frontend\controllers;

use yii\web\Controller;
use common\models\Apple;
use common\models\MF;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;


class AppleController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' =>
                    [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'create' => ['post'],
                ],
            ],
        ];
    }



    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $apples = Apple::find()->all();
        return $this->render('index',['apples'=>$apples]);
    }

    public function actionCreate()
    {
        if($data = Yii::$app->request->post())
        {
            $apple = new Apple($data['color']);

            return ($apple && $apple->id)?json_encode(array('success'=>1,'id'=>$apple->id,'position'=>$apple->position,'color'=>$apple->color)):json_encode(array('success'=>0,'message'=>'Ошибка сохранения данных'));
        }
    }
}