<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "apple".
 *
 * @property int $id
 * @property string $color
 * @property string $creationDate
 * @property string $fallTime
 * @property int $status
 * @property int|null $condition
 * @property int $eaten
 * @property int $position
 */
class Apple extends ActiveRecord
{
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
            [['creationDate', 'fallTime'], 'required'],
            [['creationDate', 'fallTime'], 'safe'],
            [['status', 'condition', 'eaten'], 'integer'],
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
            'eaten' => 'Съедено',
            'position' => 'Координаты',
        ];
    }
}
