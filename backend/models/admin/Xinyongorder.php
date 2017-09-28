<?php

namespace backend\models\admin;

use Yii;

/**
 * This is the model class for table "{{%xinyongorder}}".
 *
 * @property string $id
 * @property string $num
 * @property integer $inorout
 * @property string $time
 * @property string $orderno
 */
class Xinyongorder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%xinyongorder}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['num'], 'number'],
            [['inorout'], 'integer'],
            [['time'], 'safe'],
            [['orderno'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'num' => Yii::t('app', '金额'),
            'inorout' => Yii::t('app', '信用使用类型'),
            'time' => Yii::t('app', '时间'),
            'orderno' => Yii::t('app', '关联的订单号'),
        ];
    }
}
