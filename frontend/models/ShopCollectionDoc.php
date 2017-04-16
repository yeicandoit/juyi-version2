<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "shop_collection_doc".
 *
 * @property string $id
 * @property string $order_id
 * @property string $user_id
 * @property string $amount
 * @property string $time
 * @property string $payment_id
 * @property string $admin_id
 * @property integer $pay_status
 * @property string $note
 * @property integer $if_del
 *
 * @property ShopOrder $order
 */
class ShopCollectionDoc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_collection_doc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'user_id', 'time', 'payment_id'], 'required'],
            [['order_id', 'user_id', 'payment_id', 'admin_id', 'pay_status', 'if_del'], 'integer'],
            [['amount'], 'number'],
            [['time'], 'safe'],
            [['note'], 'string'],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShopOrder::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_id' => Yii::t('app', '订单号'),
            'user_id' => Yii::t('app', '用户ID'),
            'amount' => Yii::t('app', '金额'),
            'time' => Yii::t('app', '时间'),
            'payment_id' => Yii::t('app', '支付方式ID'),
            'admin_id' => Yii::t('app', '管理员id'),
            'pay_status' => Yii::t('app', '支付状态，0:准备，1:支付成功'),
            'note' => Yii::t('app', '收款备注'),
            'if_del' => Yii::t('app', '0:未删除 1:删除'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(ShopOrder::className(), ['id' => 'order_id']);
    }

    public function getPayment()
    {
        return $this->hasOne(ShopPayment::className(), ['id' => 'payment_id']);
    }
}
