<?php

namespace backend\models\seller;

use Yii;
/**
 * @copyright (c) 2011 王强
 * @file countsum.php
 * @brief 计算购物车中的商品价格
 * @author chendeshan
 * @date 2017-03-05
 * @version 0.6
 */
class CountSum
{
    /**
     * @brief 计算商户货款及其他费用
     * @param array $orderList 订单数据关联
     * @return array(
     * 'orderAmountPrice' => 订单金额（去掉pay_fee支付手续费）,'refundFee' => 退款金额, 'orgCountFee' => 原始结算金额,
     * 'countFee' => 实际结算金额, 'platformFee' => 平台促销活动金额(代金券等平台补贴给商家),'commission' => '手续费' ,'commissionPer' => '手续费比率',
     * 'orderNum' => 订单数量, 'order_ids' => 订单IDS,'orderNoList' => 订单编号
     * ),
     */
    public static function countSellerOrderFee($orderList)
    {
        $result = array(
            'orderAmountPrice' => 0,
            'refundFee'        => 0,
            'orgCountFee'      => 0,
            'countFee'         => 0,
            'platformFee'      => 0,
            'commission'       => 0,
            'commissionPer'    => 0,
            'orderNum'         => count($orderList),
            'order_ids'        => array(),
            'orderNoList'      => array(),
        );

        Yii::info("debug countSellerOrderFee1");
        if($orderList && is_array($orderList))
        {
            Yii::info("debug countSellerOrderFee2");
            foreach($orderList as $key => $item)
            {
                //检查平台促销活动
                //1,代金券
                if($item->prop)
                {
                    $prop = ShopProp::find()->where(['id'=>$item->prop, 'type'=>0])->one();
                    if($prop && $prop->seller_id == 0)
                    {
                        $prop->value = min($item->real_amount, $prop->value);
                        $result['platformFee'] += $prop->value;
                    }
                }

                $result['orderAmountPrice'] += $item->order_amount - $item->pay_fee;
                $result['order_ids'][]       = $item->id;
                $result['orderNoList'][]     = $item->order_no;

                //是否存在退款
                //$refundList = $refundObj->query("order_id = ".$item['id'].' and pay_status = 2');
                $refundList = ShopRefundmentDoc::find()->where(['order_id'=>$item->id, 'pay_status'=>2])->all();
                foreach($refundList as $k => $val)
                {
                    $result['refundFee'] += $val->amount;
                }
            }
        }

        //应该结算金额
        $result['orgCountFee'] = $result['orderAmountPrice'] - $result['refundFee'] + $result['platformFee'];

        //TODO what is site_config? Should look into it later!!!
        ////获取结算手续费
        //$siteConfigData = new Config('site_config');
        //$result['commissionPer'] = $siteConfigData->commission ? $siteConfigData->commission : 0;
        //$result['commission']    = round($result['orgCountFee'] * $result['commissionPer']/100,2);

        ////最终结算金额
        //$result['countFee'] = $result['orgCountFee'] - $result['commission'];

        return $result;
    }
}