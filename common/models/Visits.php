<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "visits".
 *
 * @property string $datetime datetime
 * @property int $status [1 - coming, 2 - leave]
 */
class Visits extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'visits';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['datetime', 'status'], 'required'],
            [['datetime'], 'datetime'],
            [['status'], 'in', 'range' => [1, 2]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'datetime' => 'Datetime',
            'status' => 'Status',
        ];
    }
}
