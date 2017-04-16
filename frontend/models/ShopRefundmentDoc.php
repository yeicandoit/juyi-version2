<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "shop_refundment_doc".
 *
 * @property string $id
 * @property string $order_no
 * @property string $order_id
 * @property string $user_id
 * @property string $amount
 * @property string $time
 * @property string $admin_id
 * @property integer $pay_status
 * @property string $content
 * @property string $dispose_time
 * @property string $dispose_idea
 * @property integer $if_del
 * @property string $order_goods_id
 * @property string $seller_id
 * @property integer $refund_type
 *
 * @property ShopOrder $order
 */
class ShopRefundmentDoc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_refundment_doc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'user_id'], 'required'],
            [['order_id', 'user_id', 'admin_id', 'pay_status', 'if_del', 'seller_id', 'refund_type'], 'integer'],
            [['amount'], 'number'],
            [['time', 'dispose_time'], 'safe'],
            [['content', 'dispose_idea', 'order_goods_id'], 'string'],
            [['order_no'], 'string', 'max' => 20],
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
            'order_no' => Yii::t('app', '订单号'),
            'order_id' => Yii::t('app', '订单id'),
            'user_id' => Yii::t('app', '用户ID'),
            'amount' => Yii::t('app', '退款金额'),
            'time' => Yii::t('app', '时间'),
            'admin_id' => Yii::t('app', '管理员id'),
            'pay_status' => Yii::t('app', '退款状态，0:申请退款 1:退款失败 2:退款成功'),
            'content' => Yii::t('app', '申请退款原因'),
            'dispose_time' => Yii::t('app', '处理时间'),
            'dispose_idea' => Yii::t('app', '处理意见'),
            'if_del' => Yii::t('app', '0:未删除 1:删除'),
            'order_goods_id' => Yii::t('app', '订单与商品关联ID集合'),
            'seller_id' => Yii::t('app', '商家ID'),
            'refund_type' => Yii::t('app', '1退款退货 2只退款不退货 3退还保障金 '),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(ShopOrder::className(), ['id' => 'order_id']);
    }

    public function getShopOrderGoods()
    {
        $orderGoods = ShopOrderGoods::findBySql("select * from shop_order_goods where id in ($this->order_goods_id)")->all();
        return $orderGoods;
    }

    public function refundmentText()
    {
        $result = array(0 => '申请退款', 1 => '退款失败', 2 => '退款成功');
        return isset($result[$this->pay_status]) ? $result[$this->pay_status] : '';
    }

    public function isSellerRefund()
    {
        $order = $this->order;
        if($order){
            if(1 == $order->is_checkout){
                return 1;
            } else {
                return 2;
            }
        }
        return 0;
    }
}
