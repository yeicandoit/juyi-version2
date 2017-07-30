<?php

namespace backend\models\admin;

use Yii;

/**
 * This is the model class for table "{{%transfer_log}}".
 *
 * @property string $id
 * @property integer $shopid
 * @property string $shopname
 * @property string $start_day
 * @property string $end_day
 * @property string $balance
 * @property string $account_no
 * @property integer $account_type
 * @property string $jy_trade_no
 * @property string $trade_no
 * @property string $time
 * @property string $reserve1
 * @property string $reserve2
 * @property string $reserve3
 */
class TransferLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%transfer_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shopid', 'shopname', 'start_day', 'end_day', 'account_no'], 'required'],
            [['shopid', 'account_type'], 'integer'],
            [['start_day', 'end_day', 'time'], 'safe'],
            [['balance'], 'number'],
            [['shopname', 'account_no', 'jy_trade_no', 'trade_no'], 'string', 'max' => 255],
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
            'start_day' => Yii::t('app', '开始统计日期'),
            'end_day' => Yii::t('app', '结束统计日期'),
            'balance' => Yii::t('app', '应向商家转账金额'),
            'account_no' => Yii::t('app', '到账账户'),
            'account_type' => Yii::t('app', '0:支付宝，1：银联'),
            'jy_trade_no' => Yii::t('app', '聚仪网转账交易码'),
            'trade_no' => Yii::t('app', '转账交易码'),
            'time' => Yii::t('app', '转账时间'),
            'reserve1' => Yii::t('app', 'Reserve1'),
            'reserve2' => Yii::t('app', 'Reserve2'),
            'reserve3' => Yii::t('app', 'Reserve3'),
        ];
    }
}
