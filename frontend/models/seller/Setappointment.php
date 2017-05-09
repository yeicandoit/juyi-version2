<?php

namespace frontend\models\seller;

use Yii;

/**
 * This is the model class for table "setappointment".
 *
 * @property integer $id
 * @property integer $goodid
 * @property string $appointdate
 * @property integer $numoftime1
 * @property integer $numoftime2
 * @property integer $numoftime3
 * @property integer $num1
 * @property integer $num2
 * @property integer $num3
 */
class Setappointment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%setappointment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goodid', 'numoftime1', 'numoftime2', 'numoftime3', 'num1', 'num2', 'num3'], 'integer'],
            [['appointdate'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goodid' => 'Goodid',
            'appointdate' => 'Appointdate',
            'numoftime1' => 'Numoftime1',
            'numoftime2' => 'Numoftime2',
            'numoftime3' => 'Numoftime3',
            'num1' => 'Num1',
            'num2' => 'Num2',
            'num3' => 'Num3',
        ];
    }
}
