<?php

namespace backend\models\admin;

use Yii;

/**
 * This is the model class for table "{{%shop_balance_daily}}".
 *
 * @property string $id
 * @property integer $shopid
 * @property string $shopname
 * @property string $count_day
 * @property string $balance
 * @property string $reserve1
 * @property string $reserve2
 * @property string $reserve3
 */
class ShopBalanceDaily extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop_balance_daily}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shopid', 'shopname', 'count_day'], 'required'],
            [['shopid'], 'integer'],
            [['count_day'], 'safe'],
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
            'id' => Yii::t('app', 'ID'),
            'shopid' => Yii::t('app', '商家id'),
            'shopname' => Yii::t('app', '商家登录名'),
            'count_day' => Yii::t('app', '统计日期'),
            'balance' => Yii::t('app', '商家当日收入'),
            'reserve1' => Yii::t('app', 'Reserve1'),
            'reserve2' => Yii::t('app', 'Reserve2'),
            'reserve3' => Yii::t('app', 'Reserve3'),
        ];
    }
}
