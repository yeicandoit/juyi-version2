<?php

namespace frontend\models\seller;

use Yii;

/**
 * This is the model class for table "{{%setappointment}}".
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
            ['goodid', 'required'],
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
            'id' => Yii::t('app', 'ID'),
            'goodid' => Yii::t('app', 'Goodid'),
            'appointdate' => Yii::t('app', 'Appointdate'),
            'numoftime1' => Yii::t('app', 'Numoftime1'),
            'numoftime2' => Yii::t('app', 'Numoftime2'),
            'numoftime3' => Yii::t('app', 'Numoftime3'),
            'num1' => Yii::t('app', 'Num1'),
            'num2' => Yii::t('app', 'Num2'),
            'num3' => Yii::t('app', 'Num3'),
        ];
    }
}
