<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "shop_order".
 *
 * @property string $id
 * @property string $order_no
 * @property string $user_id
 * @property integer $pay_type
 * @property integer $distribution
 * @property integer $status
 * @property integer $pay_status
 * @property integer $distribution_status
 * @property string $accept_name
 * @property string $postcode
 * @property string $telphone
 * @property integer $country
 * @property integer $province
 * @property integer $city
 * @property integer $area
 * @property string $address
 * @property string $mobile
 * @property string $payable_amount
 * @property string $real_amount
 * @property string $payable_freight
 * @property string $real_freight
 * @property string $pay_time
 * @property string $send_time
 * @property string $create_time
 * @property string $completion_time
 * @property integer $invoice
 * @property string $postscript
 * @property string $note
 * @property integer $if_del
 * @property string $insured
 * @property string $pay_fee
 * @property string $invoice_title
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
 * @property string $seller_id
 * @property integer $is_checkout
 *
 * @property ShopCollectionDoc[] $shopCollectionDocs
 * @property ShopDeliveryDoc[] $shopDeliveryDocs
 * @property ShopOrderGoods[] $shopOrderGoods
 * @property ShopOrderLog[] $shopOrderLogs
 * @property ShopRefundmentDoc[] $shopRefundmentDocs
 */
class ShopOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_no', 'user_id', 'pay_type', 'accept_name'], 'required'],
            [['user_id', 'pay_type', 'distribution', 'status', 'pay_status', 'distribution_status', 'country', 'province', 'city', 'area', 'invoice', 'if_del', 'exp', 'point', 'type', 'takeself', 'active_id', 'seller_id', 'is_checkout'], 'integer'],
            [['payable_amount', 'real_amount', 'payable_freight', 'real_freight', 'insured', 'pay_fee', 'taxes', 'promotions', 'discount', 'order_amount'], 'number'],
            [['pay_time', 'send_time', 'create_time', 'completion_time'], 'safe'],
            [['note'], 'string'],
            [['order_no', 'accept_name', 'telphone', 'mobile'], 'string', 'max' => 20],
            [['postcode'], 'string', 'max' => 6],
            [['address'], 'string', 'max' => 250],
            [['postscript', 'prop', 'trade_no', 'checkcode'], 'string', 'max' => 255],
            [['invoice_title'], 'string', 'max' => 100],
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
            'pay_type' => Yii::t('app', '用户支付方式ID,当为0时表示货到付款'),
            'distribution' => Yii::t('app', '用户选择的配送ID'),
            'status' => Yii::t('app', '订单状态 1生成订单,2支付订单,3取消订单(客户触发),4作废订单(管理员触发),5完成订单,6退款,7部分退款'),
            'pay_status' => Yii::t('app', '支付状态 0：未支付; 1：已支付;'),
            'distribution_status' => Yii::t('app', '配送状态 0：未发送,1：已发送,2：部分发送'),
            'accept_name' => Yii::t('app', '收货人姓名'),
            'postcode' => Yii::t('app', '邮编'),
            'telphone' => Yii::t('app', '联系电话'),
            'country' => Yii::t('app', '国ID'),
            'province' => Yii::t('app', '省ID'),
            'city' => Yii::t('app', '市ID'),
            'area' => Yii::t('app', '区ID'),
            'address' => Yii::t('app', '收货地址'),
            'mobile' => Yii::t('app', '手机'),
            'payable_amount' => Yii::t('app', '应付商品总金额'),
            'real_amount' => Yii::t('app', '实付商品总金额'),
            'payable_freight' => Yii::t('app', '总运费金额'),
            'real_freight' => Yii::t('app', '实付运费'),
            'pay_time' => Yii::t('app', '付款时间'),
            'send_time' => Yii::t('app', '发货时间'),
            'create_time' => Yii::t('app', '下单时间'),
            'completion_time' => Yii::t('app', 'prop时间'),
            'invoice' => Yii::t('app', '发票：0不索要1索要'),
            'postscript' => Yii::t('app', '用户附言'),
            'note' => Yii::t('app', '管理员备注'),
            'if_del' => Yii::t('app', '是否删除1为删除'),
            'insured' => Yii::t('app', '保价'),
            'pay_fee' => Yii::t('app', '支付手续费'),
            'invoice_title' => Yii::t('app', '发票抬头'),
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
            'seller_id' => Yii::t('app', '商家ID'),
            'is_checkout' => Yii::t('app', '是否给商家结算货款 0:未结算;1:已结算'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopCollectionDocs()
    {
        return $this->hasMany(ShopCollectionDoc::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopDeliveryDocs()
    {
        return $this->hasMany(ShopDeliveryDoc::className(), ['order_id' => 'id']);
    }

    public function getShopDeliveryDocSearch()
    {
        $searchModel = new ShopDeliveryDocSearch(['order_id'=>$this->id]);
        return $searchModel->search([]);
    }

    public function getFreight()
    {
        $temp = array('freight_name' => array(),'delivery_code' => array());
        foreach($this->shopDeliveryDocs as $key => $deliveryDoc){
                $temp['freight_name'][] = $deliveryDoc->freight0->freight_name;
                $temp['delivery_code'][] = $deliveryDoc->delivery_code;
        }
        $data = array('freight_name' => "",'delivery_code' => "");
        $data['freight_name'] = join(",",$temp['freight_name']);
        $data['delivery_code'] = join(",",$temp['delivery_code']);
        return $data;
    }

    public function getShopDelivery(){
        return $this->hasOne(ShopDelivery::className(), ['id'=>'distribution']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopOrderGoods()
    {
        //TODO One order id may have many goods?
        //return $this->hasMany(ShopOrderGoods::className(), ['order_id' => 'id']);
        return $this->hasOne(ShopOrderGoods::className(), ['order_id' => 'id']);
    }

    public function getSendStatus()
    {
        $data = array(0 => '未发货',1 => '已发货',2 => '已退货');
        $is_send = $this->shopOrderGoods->is_send;
        return isset($data[$is_send]) ? $data[$is_send] : '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopOrderLogs()
    {
        return $this->hasMany(ShopOrderLog::className(), ['order_id' => 'id']);
    }

    public function getShopOrderLogSearch()
    {
        $searchModel = new ShopOrderLogSearch(['order_id'=>$this->id]);
        return $searchModel->search([]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopRefundmentDocs()
    {
        return $this->hasMany(ShopRefundmentDoc::className(), ['order_id' => 'id']);
    }

    public function getShopPayment()
    {
        return $this->hasOne(ShopPayment::className(), ['id' => 'pay_type']);
    }

    public  function getOrderStep()
    {
        $result = array();
        //1,创建订单
        $result[$this->create_time] = '订单创建';
        //2,订单支付
        if($this->pay_status > 0)
        {
            $result[$this->pay_time] = '订单付款  '.$this->order_amount;
        }
        //3,订单配送
        if($this->distribution_status > 0)
        {
            $result[$this->send_time] = '订单发货完成';
        }
        //4,订单完成
        if($this->status == 5)
        {
            $result[$this->completion_time] = '订单完成';
        }
        ksort($result);
        return $result;
    }

    public function getAcceptAdr()
    {
        $province = ShopAreas::findOne($this->province);
        $city = ShopAreas::findOne($this->city);
        $area = ShopAreas::findOne($this->area);

        $acceptAdr = '';
        if($province){
            $acceptAdr = $acceptAdr . $province->area_name;
        }
        if($city){
            $acceptAdr = $acceptAdr . $city->area_name;
        }
        if($area){
            $acceptAdr = $acceptAdr . $area->area_name;
        }
        return $acceptAdr = $acceptAdr . $this->area;
    }

    public function getOrderStatus()
    {
        //1,刚生成订单,未付款
        if($this->status == 1)
        {
            //选择货到付款
            if($this->pay_type == 0)
            {
                if($this->distribution_status == 0)
                {
                    return 1;
                }
                else if($this->distribution_status == 1)
                {
                    return 11;
                }
                else if($this->distribution_status == 2)
                {
                    return 8;
                }
            }
            //选择在线支付
            else
            {
                return 2;
            }
        }
        //2,已经付款
        else if($this->status == 2)
        {
            //TODO check ShopRefundmentDoc' where condition is right or not.
            $refundRow = ShopRefundmentDoc::find()->where(['order_id' => $this->id, 'if_del'=>0, 'pay_status'=>0])->one();
            if($refundRow)
            {
                return 12;
            }

            if($this->distribution_status == 0)
            {
                return 4;
            }
            else if($this->distribution_status == 1)
            {
                return 3;
            }
            else if($this->distribution_status == 2)
            {
                return 8;
            }
        }
        //3,取消或者作废订单
        else if($this->status == 3 || $this->status == 4)
        {
            return 5;
        }
        //4,完成订单
        else if($this->status == 5)
        {
            return 6;
        }
        //5,退款
        else if($this->status == 6)
        {
            return 7;
        }
        //6,部分退款
        else if($this->status == 7)
        {
            //发货
            if($this->distribution_status == 1)
            {
                return 10;
            }
            //未发货
            else
            {
                return 9;
            }
        }
        return '未知';
    }

    public static function orderStatusText($statusCode)
    {
        $result = array(
            0 => '未知',
            1 => '等待发货',
            2 => '等待付款',
            3 => '已发货',
            4 => '等待发货',
            5 => '已取消',
            6 => '已完成',
            7 => '已退款',
            8 => '部分发货',
            9 => '部分发货',
            10=> '部分退款',
            11=> '已发货',
            12=> '申请退款',
        );
        return isset($result[$statusCode]) ? $result[$statusCode] : '';
    }

    public function getOrderPayStatusText($statusCode){
        $result = array(
            0 => '未付款',
            1 => '已付款',
            6 => '全部退款',
            7 => '部分退款',
        );
        return isset($result[$statusCode]) ? $result[$statusCode] : '未知';
    }

    public function isGoDelivery()
    {
        /* 1,已经完全发货
		 * 2,非货到付款，并且没有支付*/
        if($this->distribution_status == 1 || ($this->pay_type != 0 && $this->pay_status == 0))
        {
            return false;
        }
        return true;
    }

    public function getOrderTypeText()
    {
        switch($this->type)
        {
            case "1":
            {
                return '团购订单';
            }
                break;

            case "2":
            {
                return '抢购订单';
            }
                break;

            default:
            {
                return '普通订单';
            }
        }
    }

    //获取订单配送状态
    public function getOrderDistributionStatusText()
    {
        if($this->status == 5)
        {
            return '已收货';
        }
        else if($this->distribution_status == 1)
        {
            return '已发货';
        }
        else if($this->distribution_status == 0)
        {
            return '未发货';
        }
        else if($this->distribution_status == 2)
        {
            return '部分发货';
        }
    }
}
