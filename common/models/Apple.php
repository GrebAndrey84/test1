<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "apple".
 *
 * @property int $id
 * @property string $color
 * @property int $creationDate
 * @property int $fallTime
 * @property int $status
 * @property int $size
 * @property int $position
 */
class Apple extends ActiveRecord
{
    const STATUS_ON_TREE = 1; //яблоко на дереве
    const STATUS_ON_GROUND = 5; //яблоко на земле
    const POSITION = array(3,4,5,12,13,14,15,16,21,22,23,24,25,26,27,32,33,34,35,36); //свободные позиции для яблок на дереве
    const POSITION_ON_GROUND = array(41,42,43,45,46,47,51,52,53,54,55,56,57,61,62,63,64,65,66,67); //свободные позиции для яблок на земле
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apple';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['creationDate','position'], 'required'],
            [['creationDate', 'fallTime'], 'safe'],
            [['status', 'size','position'], 'integer'],
            [['color'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color' => 'Цвет',
            'creationDate' => 'Дата появления',
            'fallTime' => 'Дата падения',
            'status' => 'Статус',
            'size' => 'Съедено',
            'position' => 'Координаты',
        ];
    }

    public function __construct($color=null, array $config = [])
    {
        parent::__construct($config);
        if($color && $this::find()->count() < count(self::POSITION))
        {
            $this->color = $color;
            $this->creationDate = rand(10000000,time());
            $this->status = self::STATUS_ON_TREE;
            $this->position = self::FreePositionOnTree();
            $this->save();
        }
    }
    /**
     * Поиск свободной позиции на дереве
     *
     * @return int
     */
    public static function FreePositionOnTree()
    {
        foreach ($busyPos = self::find()->select('position')->where(['status'=>self::STATUS_ON_TREE])->asArray()->all() as $k=>$v)
            $busyPos[$k] = $v['position'];
        $freePos = array_diff(self::POSITION,$busyPos);
        return $freePos?$freePos[array_rand($freePos)]:false;
    }

    /**
     * Поискк свободной позиции на земле
     *
     * @return int
     */
    public static function FreePositionOnGround()
    {
        foreach ($busyPos = self::find()->select('position')->where(['status'=>self::STATUS_ON_GROUND])->asArray()->all() as $k=>$v)
            $busyPos[$k] = $v['position'];

        $freePos = array_diff(self::POSITION_ON_GROUND,$busyPos);
        return $freePos?$freePos[array_rand($freePos)]:false;
    }



}
