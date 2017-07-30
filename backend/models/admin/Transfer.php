<?php

namespace backend\models\admin;

use Yii;

/**
 * This is the model class for table "{{%transfer}}".
 *
 * @property integer $shopid
 * @property string $shopname
 * @property string $start_day
 * @property string $end_day
 * @property string $balance
 * @property integer $state
 * @property string $reserve1
 * @property string $reserve2
 * @property string $reserve3
 */
class Transfer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%transfer}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shopid', 'shopname', 'start_day', 'end_day'], 'required'],
            [['shopid', 'state'], 'integer'],
            [['start_day', 'end_day'], 'safe'],
            [['balance'], 'number'],
            [['shopname'], 'string', 'max' => 255],
            [['reserve1', 'reserve2', 'reserve3'], 'string', 'max' => 512],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'shopid' => Yii::t('app', '商家id'),
            'shopname' => Yii::t('app', '商家登录名'),
            'start_day' => Yii::t('app', '开始统计日期'),
            'end_day' => Yii::t('app', '结束统计日期'),
            'balance' => Yii::t('app', '应向商家转账金额'),
            'state' => Yii::t('app', '0:未转账，1：已转账'),
            'reserve1' => Yii::t('app', 'Reserve1'),
            'reserve2' => Yii::t('app', 'Reserve2'),
            'reserve3' => Yii::t('app', 'Reserve3'),
        ];
    }
}
