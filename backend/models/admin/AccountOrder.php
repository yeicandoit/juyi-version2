<?php

namespace backend\models\admin;

use Yii;

/**
 * This is the model class for table "{{%account_order}}".
 *
 * @property string $id
 * @property integer $userid
 * @property string $account_no
 * @property string $number
 * @property string $name
 * @property string $trade_no
 * @property string $order_no
 * @property string $time
 * @property integer $type
 * @property integer $inorout
 * @property integer $state
 * @property integer $adminid
 */
class AccountOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%account_order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userid', 'account_no', 'state'], 'required'],
            [['userid', 'type', 'inorout', 'state', 'adminid'], 'integer'],
            [['number'], 'number'],
            [['time'], 'safe'],
            [['account_no', 'name', 'trade_no', 'order_no'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'userid' => Yii::t('app', '用户id'),
            'account_no' => Yii::t('app', '本次帐号交易号'),
            'number' => Yii::t('app', '金额'),
            'name' => Yii::t('app', '转帐账户，如果是管理员操作，为0;系统从账户扣款，为1'),
            'trade_no' => Yii::t('app', 'ת'),
            'order_no' => Yii::t('app', 'Order No'),
            'time' => Yii::t('app', '转账完成时间'),
            'type' => Yii::t('app', '转账类型 1 支付宝 2 银联 3管理员直接操作'),
            'inorout' => Yii::t('app', '0向账户充值 1 从账户支出'),
            'state' => Yii::t('app', '0 未完成 1 完成'),
            'adminid' => Yii::t('app', '管理员id，如果非管理员，则为0'),
        ];
    }
}
