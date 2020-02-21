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

    /**
     * Создает яблоко на дереве. Яблоко создается в констсрукторе при передачи в него цвета
     *
     * @return mixed
     */
    public function actionCreate()
    {
        if($data = Yii::$app->request->post())
        {
            $apple = new Apple($data['color']);
            return ($apple && $apple->id)?json_encode(array('success'=>1,'id'=>$apple->id,'position'=>$apple->position,'color'=>$apple->color, 'size'=>100)):json_encode(array('success'=>0,'message'=>'Это максимум для данного дерева. Сначала надо съесть упавшие'));
        }
    }

    /**
     * Срываем яблоко
     *
     * @return mixed
     */
    public function actionTear()
    {
        if($data = Yii::$app->request->post())
        {
            $apple = Apple::findOne($data['id']);
            if($apple->status == Apple::STATUS_ON_TREE)
            {
                $oldposition = $apple->position;
                $apple->position = Apple::FreePositionOnGround();
                $apple->status = Apple::STATUS_ON_GROUND;
                $apple->fallTime = time();
                return $apple->save() ? json_encode(array('success'=>1,'id'=>$apple->id,'position'=>$apple->position,'oldposition'=>$oldposition, 'color'=>$apple->color, 'size' => $apple->size)):json_encode(array('success'=>0,'message'=>'Ошибка срыва яблока... обратитесь к садовнику'));
            }
            else
                return json_encode(array('success'=>0,'message'=>'Яблоко уже сорвано. Повторно сорвать не получится'));

        }
        return false;
    }

    /**
     * Съедаем яблоко
     *
     * @return mixed
     */
    public function actionEat()
    {
        if($data = Yii::$app->request->post())
        {
            $apple = Apple::findOne($data['id']);
            if($apple && $apple->status == Apple::STATUS_ON_GROUND)
            {
                if(round((time()-$apple->fallTime)/60)>300)
                    return json_encode(array('success'=>0,'message'=>'Яблоко испортилось.'));

                if($apple->size == $data['eat'])
                    return $apple->delete() ? json_encode(array('success'=>1,'position'=>$apple->position,'size'=>0)):json_encode(array('success'=>0,'message'=>'Ошибка поедания яблока... обратитесь к садовнику'));

                $apple->size-=$data['eat'];

                return $apple->save() ? json_encode(array('success'=>1,'position'=>$apple->position,'size'=>$apple->size)):json_encode(array('success'=>0,'message'=>'Ошибка поедания яблока... обратитесь к садовнику'));
            }
            else
                return json_encode(array('success'=>0,'message'=>'Яблоко съесть не получится. Его сначала нужно сорвать'));

        }
        return false;
    }
}