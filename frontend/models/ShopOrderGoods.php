<?php

namespace frontend\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "shop_order_goods".
 *
 * @property string $id
 * @property string $order_id
 * @property string $goods_id
 * @property string $img
 * @property string $product_id
 * @property string $goods_price
 * @property string $real_price
 * @property integer $goods_nums
 * @property string $goods_weight
 * @property string $goods_array
 * @property integer $is_send
 * @property integer $delivery_id
 * @property string $seller_id
 *
 * @property ShopOrder $order
 */
class ShopOrderGoods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_order_goods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'goods_id', 'img'], 'required'],
            [['order_id', 'goods_id', 'product_id', 'goods_nums', 'is_send', 'delivery_id', 'seller_id'], 'integer'],
            [['goods_price', 'real_price', 'goods_weight'], 'number'],
            [['goods_array'], 'string'],
            [['img'], 'string', 'max' => 255],
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
            'order_id' => Yii::t('app', '订单ID'),
            'goods_id' => Yii::t('app', '商品ID'),
            'img' => Yii::t('app', '商品图片'),
            'product_id' => Yii::t('app', '货品ID'),
            'goods_price' => Yii::t('app', '商品原价'),
            'real_price' => Yii::t('app', '实付金额'),
            'goods_nums' => Yii::t('app', '商品数量'),
            'goods_weight' => Yii::t('app', '重量'),
            'goods_array' => Yii::t('app', '商品和货品名称name和规格value串json数据格式'),
            'is_send' => Yii::t('app', '是否已发货 0:未发货;1:已发货;2:已经退货'),
            'delivery_id' => Yii::t('app', '配送单ID'),
            'seller_id' => Yii::t('app', '商家ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(ShopOrder::className(), ['id' => 'order_id']);
    }

    public function getGoods()
    {
        return $this->hasOne(ShopGoods::className(), ['id' => 'goods_id']);
    }

    public function goodsSendStatus()
    {
        $data = array(0 => '未发货',1 => '已发货',2 => '已退货');
        return isset($data[$this->is_send]) ? $data[$this->is_send] : '';
    }

    /**
     * @brief 获取商家销售额统计数据
     * @param int $seller_id 商家ID
     * @param string $start 开始日期 Y-m-d
     * @param string $end   结束日期 Y-m-d
     * @return array key => 日期时间,value => 销售金额
     */
    public static function sellerAmount($seller_id, $start = '', $end = '')
    {
        $query = (new Query())->from('shop_order_goods og');
        $query->leftJoin('shop_order o', 'o.id = og.order_id');
        $query->select('sum(og.real_price * og.goods_nums) as yValue, o.pay_time');
        $query->where("og.is_send=1 AND og.seller_id=$seller_id AND o.pay_status=1");
        return self::ParseCondition($query,'o.pay_time',$start,$end);
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
            $result[$val['xValue']] = intval($val['yValue']);
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

}
