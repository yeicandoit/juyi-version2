<?php

namespace frontend\models\seller;

use Yii;

/**
 * This is the model class for table "{{%order}}".
 *
 * @property string $id
 * @property string $order_no
 * @property string $user_id
 * @property string $seller_id
 * @property integer $appointid
 * @property integer $pay_type
 * @property integer $invoice
 * @property string $invoice_title
 * @property integer $status
 * @property integer $pay_status
 * @property integer $distribution_status
 * @property string $create_time
 * @property string $payable_amount
 * @property string $postscript
 * @property integer $sendbackornot
 * @property string $accept_name
 * @property string $telphone
 * @property string $postcode
 * @property integer $country
 * @property integer $province
 * @property integer $city
 * @property integer $area
 * @property string $address
 * @property string $completion_time
 * @property string $payable_freight
 * @property string $mobile
 * @property string $real_amount
 * @property integer $distribution
 * @property string $real_freight
 * @property string $pay_time
 * @property string $send_time
 * @property string $note
 * @property integer $if_del
 * @property string $insured
 * @property string $pay_fee
 * @property string $taxes
 * @property string $promotions
 * @property string $discount
 * @property string $order_amount
 * @property string $prop
 * @property string $accept_time
 * @property integer $exp
 * @property integer $point
 * @property integer $type
 * @property string $trade_no
 * @property string $takeself
 * @property string $checkcode
 * @property string $active_id
 * @property integer $is_checkout
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_no', 'user_id', 'pay_type'], 'required'],
            [['user_id', 'seller_id', 'appointid', 'pay_type', 'invoice', 'status', 'pay_status', 'distribution_status', 'sendbackornot', 'country', 'province', 'city', 'area', 'distribution', 'if_del', 'exp', 'point', 'type', 'takeself', 'active_id', 'is_checkout'], 'integer'],
            [['create_time', 'completion_time', 'pay_time', 'send_time'], 'safe'],
            [['payable_amount', 'payable_freight', 'real_amount', 'real_freight', 'insured', 'pay_fee', 'taxes', 'promotions', 'discount', 'order_amount'], 'number'],
            [['note'], 'string'],
            [['order_no', 'accept_name', 'telphone', 'mobile'], 'string', 'max' => 20],
            [['invoice_title'], 'string', 'max' => 100],
            [['postscript', 'prop', 'trade_no', 'checkcode'], 'string', 'max' => 255],
            [['postcode'], 'string', 'max' => 6],
            [['address'], 'string', 'max' => 250],
            [['accept_time'], 'string', 'max' => 80],
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
            'user_id' => Yii::t('app', '用户ID'),
            'seller_id' => Yii::t('app', '商家ID'),
            'appointid' => Yii::t('app', '关联的预约单'),
            'pay_type' => Yii::t('app', '用户支付方式ID,当为0时表示货到付款'),
            'invoice' => Yii::t('app', '发票：0不索要1 普通发票 2 增值税发票'),
            'invoice_title' => Yii::t('app', '发票抬头'),
            'status' => Yii::t('app', '订单状态 1生成订单,2支付订单,3取消订单(客户触发),4作废订单(管理员触发),5完成订单,6退款(订单完成后),7部分退款(订单完成后)'),
            'pay_status' => Yii::t('app', '支付状态 0：未支付; 1：已支付;'),
            'distribution_status' => Yii::t('app', '配送状态 0：未发送,1：已发送,2：部分发送'),
            'create_time' => Yii::t('app', '下单时间'),
            'payable_amount' => Yii::t('app', '应付商品总金额'),
            'postscript' => Yii::t('app', '用户附言'),
            'sendbackornot' => Yii::t('app', '是否需要回寄'),
            'accept_name' => Yii::t('app', '收货人姓名'),
            'telphone' => Yii::t('app', '联系电话'),
            'postcode' => Yii::t('app', '邮编'),
            'country' => Yii::t('app', '国ID'),
            'province' => Yii::t('app', '省ID'),
            'city' => Yii::t('app', '市ID'),
            'area' => Yii::t('app', '区ID'),
            'address' => Yii::t('app', '收货地址'),
            'completion_time' => Yii::t('app', '订单完成时间'),
            'payable_freight' => Yii::t('app', '总运费金额'),
            'mobile' => Yii::t('app', '手机'),
            'real_amount' => Yii::t('app', '实付商品总金额'),
            'distribution' => Yii::t('app', '用户选择的配送ID'),
            'real_freight' => Yii::t('app', '实付运费'),
            'pay_time' => Yii::t('app', '付款时间'),
            'send_time' => Yii::t('app', '发货时间'),
            'note' => Yii::t('app', '管理员备注'),
            'if_del' => Yii::t('app', '是否删除1为删除'),
            'insured' => Yii::t('app', '保价'),
            'pay_fee' => Yii::t('app', '支付手续费'),
            'taxes' => Yii::t('app', '税金'),
            'promotions' => Yii::t('app', '促销优惠金额'),
            'discount' => Yii::t('app', '订单折扣或涨价'),
            'order_amount' => Yii::t('app', '订单总金额'),
            'prop' => Yii::t('app', '使用的道具id'),
            'accept_time' => Yii::t('app', '用户收货时间'),
            'exp' => Yii::t('app', '增加的经验'),
            'point' => Yii::t('app', '增加的积分'),
            'type' => Yii::t('app', '0普通订单,1团购订单,2限时抢购'),
            'trade_no' => Yii::t('app', '支付平台交易号'),
            'takeself' => Yii::t('app', '自提点ID'),
            'checkcode' => Yii::t('app', '自提方式的验证码'),
            'active_id' => Yii::t('app', '促销活动ID'),
            'is_checkout' => Yii::t('app', '是否给商家结算货款 0:未结算 1:已结算'),
        ];
    }
}
