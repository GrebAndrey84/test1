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
 * @property int|null $condition
 * @property int $size
 * @property int $position
 */
class Apple extends ActiveRecord
{
    const STATUS_ON_TREE = 1;
    const STATUS_ON_GROUND = 5;
    const POSITION = array(3,4,5,12,13,14,15,16,21,22,23,24,25,26,27,32,33,34,35,36);
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
            [['status', 'condition', 'size','position'], 'integer'],
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
            'condition' => 'Состяние',
            'size' => 'Съедено',
            'position' => 'Координаты',
        ];
    }

    public function __construct($color, array $config = [])
    {
        parent::__construct($config);
        $this->color = $color;
        $this->creationDate = rand(10000000,time());
        $this->status = self::STATUS_ON_TREE;
        $this->position = self::FreePositionOnTree();
        MF::db($this->position);
        $this->save();
    }

    public static function FreePositionOnTree()
    {
        foreach ($busyPos = self::find()->select('position')->asArray()->all() as $k=>$v)
            $busyPos[$k] = $v['position'];
        $freePos = array_diff(self::POSITION,$busyPos);
        MF::db($busyPos);
        MF::db($freePos);
        return $freePos?$freePos[rand(0,count($freePos))]:false;
    }



}
