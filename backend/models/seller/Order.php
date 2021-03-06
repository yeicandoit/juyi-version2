<?php

namespace backend\models\seller;

use Yii;
use yii\db\Query;

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
    const INVOICE_NO = 0;
    const INVOICE_NOR = 1;
    const INVOICE_ZEN = 2;
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
            [['create_time', 'completion_time', 'pay_time', 'send_time', 'shibiehao'], 'safe'],
            [['payable_amount', 'payable_freight', 'real_amount', 'real_freight', 'insured', 'pay_fee', 'taxes', 'promotions', 'discount', 'order_amount'], 'number'],
            [['note'], 'string'],
            [['order_no', 'accept_name', 'telphone', 'mobile'], 'string', 'max' => 20],
            [['invoice_title'], 'string', 'max' => 100],
            [['postscript', 'prop', 'trade_no', 'checkcode', 'shibiehao'], 'string', 'max' => 255],
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
            'pay_type' => Yii::t('app', '用户支付方式ID,0 账户支付, 1 支付宝, 2 银联, 3 账户直接支付, 4 信用支付'),
            'invoice' => Yii::t('app', '发票：0不索要1 普通发票 2 增值税发票'),
            'invoice_title' => Yii::t('app', '发票抬头'),
            'status' => Yii::t('app', '1 订单生成 2 买家寄出样品 3 商家收到样品，测试进行 4 商家发送测试数据 5 商家回寄样品 6 买家收到回寄样品 7 交易完成'),
            'pay_status' => Yii::t('app', '支付状态 0：未支付; 1：已支付; 2: 信用支付'),
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
            'shibiehao' => Yii::t('app', '纳税人识别号'),
        ];
    }

    public function getStat()
    {
        $status = array(
            1=>'订单生成',
            2=>'买家寄出样品',
            3=>'收到样品',
            4=>'寄回测试数据',
            5=>'回寄样品或商品',
            6=>'买家收到回寄样品、数据',
            7=>'交易完成'
        );

        return $status[$this->status];
    }

    public static function getStatArr()
    {
        return array(
            1=>'订单生成',
            2=>'买家寄出样品',
            3=>'收到样品',
            4=>'寄回测试数据',
            5=>'回寄样品',
            6=>'买家收到回寄样品、数据',
            7=>'交易完成'
        );
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id'=>'user_id']);
    }

    public function getShopMember()
    {
        return $this->hasOne(ShopMember::className(), ['id'=>'seller_id']);
    }

    public static function getOrderTypeArr()
    {
        return array(
            ShopMember::TYPE_TEST=>'检测中心',
            ShopMember::TYPE_EXPERT=>'专家解码',
            ShopMember::TYPE_RESEARCH=>'科研辅助',
            ShopMember::TYPE_SIMULATE=>'数值模拟',
        );
    }

    public function getOrderType()
    {
        $type = array(
            ShopMember::TYPE_TEST=>'检测中心',
            ShopMember::TYPE_EXPERT=>'专家解码',
            ShopMember::TYPE_RESEARCH=>'科研辅助',
            ShopMember::TYPE_SIMULATE=>'数值模拟',
        );
        return $type[ShopMember::findOne($this->seller_id)->regtype];
    }

    public function getRefundment()
    {
        return $this->hasOne(RefundmentDoc::className(),['order_id'=>'id']);
    }

    public function getPayStatus()
    {
        $payStatus = array(
            0=>'未支付',
            1=>'已支付',
            2=>'信用支付',
        );
        $refundmentStatus = array(
            0=>'申请退款',
            1=>'同意退款，退款进行',
            2=>'不同意退款',
            3=>'系统仲裁退款',
            4=>'退款完成',
        );

        $stat = $payStatus[$this->pay_status];
        if($this->refundment){
            return $refundmentStatus[$this->refundment->pay_status];
        }
        return $stat;
    }

    public function getOrderTypeText()
    {
        $orderType = array(
            0=>'普通订单',
            1=>'团购订单',
            2=>'限时抢购'
        );
        return $orderType[$this->type];
    }

    public function getOrderDistributionStatusText()
    {
        $status = array(
            0=>'未发送',
            1=>'已发送'
        );
        return $status[$this->distribution_status];
    }

    public function getAppointinfo()
    {
        return $this->hasOne(Appointinfo::className(), ['appointid'=>'appointid']);
    }

    public function getDelivery($userid)
    {
        //return $this->hasOne(Delivery::className(), ['id'=>'distribution']);
        $orderDelivery = OrderDelivery::find()->where(['oderid'=>$this->id, 'userid'=>$userid, 'usertype'=>0])->one();
        if($orderDelivery) {
            return Delivery::findOne($orderDelivery->deliveryid);
        } else {
            return false;
        }
    }

    public function getDeliveryBack()
    {
        $orderDelivery = OrderDelivery::find()->where(['oderid'=>$this->id, 'userid'=>$this->seller_id, 'usertype'=>1])->one();
        if($orderDelivery) {
            return Delivery::findOne($orderDelivery->deliveryid);
        } else {
            return false;
        }
    }

    public static function getSale($seller_id, $shopType = null)
    {
        $query = (new Query())->from('jy_order o');
        $query->select('sum(o.realpay_amount) as sale');
        if($seller_id) {
            $query->where("o.seller_id=$seller_id AND o.status>=6");
        } else {
            $query->where("o.status >= 6");
        }
        if(isset($shopType)){
            $query->leftJoin('jy_shop_member s', 'o.seller_id=s.id');
            $query->andWhere("s.regtype=\"$shopType\"");
        }
        $result = $query->all();
        if(count($result) > 0){
            return $result[0]['sale'];
        }
    }

    /**
     * @brief 获取商家销售额统计数据
     * @param int $seller_id 商家ID
     * @param string $start 开始日期 Y-m-d
     * @param string $end   结束日期 Y-m-d
     * @return array key => 日期时间,value => 销售金额
     */
    public static function sellerAmount($seller_id, $start = '', $end = '', $shopType = null)
    {
        $query = (new Query())->from('jy_order');
        $query->select('sum(realpay_amount) as yValue, completion_time');
        if($seller_id) {
            $query->where("seller_id=$seller_id AND status>=6");
        } else {
            $query->where("status >= 6");
        }

        if(isset($shopType)){
            $query->leftJoin('jy_shop_member', 'seller_id=jy_shop_member.id');
            $query->andWhere("jy_shop_member.regtype=\"$shopType\"");
        }

        return self::ParseCondition($query,'completion_time',$start,$end);
    }

    /**
     * @brief 处理条件
     * @param IQuery $db 数据库IQuery对象
     * @param string $timeCols 时间字段名称
     * @param string $start 开始日期 Y-m-d
     * @param string $end   结束日期 Y-m-d
     */
    private static function ParseCondition($query, $timeCols = 'time', $start = '', $end = '')
    {
        $result     = array();

        //获取时间段
        $date       = self::dateParse($start, $end);
        $startArray = explode('-',$date[0]);
        $endArray   = explode('-',$date[1]);
        $diffSec    = ITime::getDiffSec($date[0],$date[1]);

        switch(self::groupByCondition($diffSec))
        {
            //按照年
            case "y":
            {
                $startCondition = $startArray[0];
                $endCondition   = $endArray[0]+1;
                $query->addSelect(['xValue'=>"DATE_FORMAT($timeCols,'%Y')"]);
                $query->groupBy(['groupDate'=>"DATE_FORMAT($timeCols,'%Y')"]);
                $query->having(['>=', $timeCols, $startCondition]);
                $query->andHaving(['<', $timeCols, $endCondition]);
            }
                break;

            //按照月
            case "m":
            {
                $startCondition = $startArray[0].'-'.$startArray[1];
                $endCondition   = $endArray[1] == 12 ? ($endArray[0]+1) : $endArray[0].'-'.($endArray[1]+1);
                $query->addSelect(['xValue'=>"DATE_FORMAT($timeCols,'%Y-%m')"]);
                $query->groupBy(['groupDate'=>"DATE_FORMAT($timeCols,'%Y-%m')"]);
                $query->having(['>=', $timeCols, $startCondition]);
                $query->andHaving(['<', $timeCols, $endCondition]);
            }
                break;

            //按照日
            case "d":
            {
                $startCondition = $startArray[0].'-'.$startArray[1].'-'.$startArray[2];
                $endCondition   = $endArray[0].'-'.$endArray[1].'-'.$endArray[2].' 23:59:59';
                $query->addSelect(['xValue'=>"DATE_FORMAT($timeCols,'%m-%d')"]);
                $query->groupBy(['groupDate'=>"DATE_FORMAT($timeCols,'%Y-%m-%d')"]);
                $query->having(['>=', $timeCols, $startCondition]);
                $query->andHaving(['<', $timeCols, $endCondition]);
            }
                break;
        }
        $data = $query->all();
        foreach($data as $key => $val)
        {
            $result[$val['xValue']] = floatval($val['yValue']);
        }
        return $result;
    }

    /**
     * @brief 日期的智能处理
     * @param string $start 开始日期 Y-m-d
     * @param string $end   结束日期 Y-m-d
     */
    public static function dateParse($start = '',$end = '')
    {
        $format = 'Y-m-d';
        //默认没有时间条件,查询之前7天的数据
        if(!$start && !$end)
        {
            $diffSec = 86400 * 6;
            $beforeDate = ITime::pass(-$diffSec,$format);
            return array($beforeDate,ITime::getNow($format));
        }

        //有时间条件
        if($start && $end)
        {
            return array($start,$end);
        }
        else if($start)
        {
            return array($start,$start);
        }
        else if($end)
        {
            return array($end,$end);
        }
    }

    /**
     * @brief 根据条件分组
     * @param int 相差的秒数
     * @return string y年,m月,d日
     */
    private static function groupByCondition($diffSec)
    {
        $diffSec = abs($diffSec);
        //按天分组，小于30个天
        if($diffSec <= 86400 * 30)
        {
            return 'd';
        }
        //按月分组，小于24个月
        else if($diffSec <= 86400 * 30 * 24)
        {
            return 'm';
        }
        //按年分组
        else
        {
            return 'y';
        }
    }

    public function getShop()
    {
        $shopMember = ShopMember::findOne($this->seller_id);          
        return $shopMember->shopInfo;
    }

    public function getIsSeller()
    {
        return ShopMember::findOne($this->seller_id)->regtype == 'seller';
    }

    public function getInvoiceType()
    {
        $arr = array(
            self::INVOICE_NO => '不需要',
            self::INVOICE_NOR => '普通发票',
            self::INVOICE_ZEN => '增值税发票',
        );
        return $arr[$this->invoice];
    }
}
