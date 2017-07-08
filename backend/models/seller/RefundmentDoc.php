<?php

namespace backend\models\seller;

use Yii;

/**
 * This is the model class for table "{{%refundment_doc}}".
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
 * @property string $way
 * @property integer $reason
 *
 * @property Order $order
 */
class RefundmentDoc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%refundment_doc}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'user_id'], 'required'],
            [['order_id', 'user_id', 'admin_id', 'pay_status', 'if_del', 'seller_id', 'reason'], 'integer'],
            [['amount'], 'number'],
            [['time', 'dispose_time'], 'safe'],
            [['content', 'dispose_idea', 'order_goods_id'], 'string'],
            [['order_no', 'way'], 'string', 'max' => 20],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
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
            'pay_status' => Yii::t('app', '退款状态,0:申请退款，等待商家处理 1：商家同意，退款进行 2:商家不同意 3. 系统正在仲裁 4:退款完成'),
            'content' => Yii::t('app', '申请退款说明'),
            'dispose_time' => Yii::t('app', '处理时间'),
            'dispose_idea' => Yii::t('app', '处理意见'),
            'if_del' => Yii::t('app', '0:未删除 1:删除'),
            'order_goods_id' => Yii::t('app', '订单与商品关联ID集合'),
            'seller_id' => Yii::t('app', '商家ID'),
            'way' => Yii::t('app', '退款方式,balance:用户余额 other:其他方式 origin:原路退回'),
            'reason' => Yii::t('app', '退款原因'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    public function getStatus()
    {
        $statArr = array(
            0=>'申请退款',
            1=>'同意退款，退款进行',
            2=>'不同意退款',
            3=>'系统正在仲裁',
            4=>'退款完成',
        );
        return $statArr[$this->pay_status];
    }

    public static function getStatArr()
    {
        return array(
            0=>'申请退款',
            1=>'同意退款，退款进行',
            2=>'不同意退款',
            3=>'系统正在仲裁',
            4=>'退款完成',
        );
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id'=>'user_id']);
    }
}
