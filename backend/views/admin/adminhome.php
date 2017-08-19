<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<!--Show seller info-->
<style type="text/css">
    .border_table_org{border:1px solid #116fb5;margin:10px 5px;background:#fff; float: left; min-width: 400px;}
    .border_table_org th{padding:3px 10px 3px 17px; font-size:14px;vertical-align:middle;white-space:nowrap;word-break:keep-all;}
    .border_table_org td{padding:4px 5px;text-align: right}
    .border_table_org thead th{color:#fff;white-space:nowrap;text-align:center; text-align:left; padding-left:17px;background-color: #116fb5}
</style>
<div class="sellerinfo">
    <div>
        <table cellspacing="0" cellpadding="5" class="border_table_org">
            <thead>
            <tr><th>基础统计</th></tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <table class="list_table2" width="100%">
                        <colgroup>
                            <col width="80px" />
                            <col />
                        </colgroup>
                        <tbody>
                        <tr><th>检测中心</th><td><?=Html::a($summary['testCnt'] . '家 ', Url::to(['admin/sellerlist']))?></td></tr>
                        <tr><th>科研辅助</th><td><?=Html::a($summary['researchCnt'] . '家 ', Url::to(['admin/researchlist']))?></td></tr>
                        <tr><th>数值模拟</th><td><?=Html::a($summary['simulateCnt'] . '家 ', Url::to(['admin/simulatelist']))?></td></tr>
                        <tr><th>专家数量</th><td><?=Html::a($summary['expertCnt'] . '个 ', Url::to(['admin/expertlist']))?></td></td></tr>
                        <tr><th>销售总额</th><td><?=Html::a($summary['account'] . '元 ', Url::to(['admin/account']))?></td></tr>
                        <tr><th>注册用户</th><td><?=Html::a($summary['userCnt'] . '个 ', Url::to(['admin/memberlist']))?></td></tr>
                        <tr><th>商品数量</th><td><?=Html::a($summary['goodsCnt'] . '个 ', Url::to(['admin/goodslist']))?></td></tr>
                        <tr><th>订单数量</th><td><?=Html::a($summary['orderCnt'] . '单 ', Url::to(['admin/orderlist']))?></td></tr>
                        <tr><th>预约数量</th><td><?=Html::a($summary['appointCnt'] . '个 ', Url::to(['admin/appointlist']))?></td></tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
        <table cellspacing="0" cellpadding="5" class="border_table_org" >
            <thead>
            <tr><th>待处理</th></tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <table class="list_table2" width="100%">
                        <colgroup>
                            <col width="80px" />
                            <col />
                        </colgroup>
                        <tbody>
                        <tr><th>待审商家</th><td><?=Html::a($summary['shopCnt_'] . '家', Url::to(['admin/sellerlist', 'SellerSearch[is_del]'=>1]))?></td></tr>
                        <tr><th>待审商品</th><td><?=Html::a($summary['goodsCnt_'] . '个', Url::to(['admin/goodslist','GoodsSearch[is_del]'=>3]))?></td></tr>
                        <tr><th>未完成订单</th><td><?=Html::a($summary['orderCnt_'] . '单', Url::to(['admin/orderstay']))?></td></tr>
                        <tr><th>待回复咨询</th><td><?=Html::a($summary['consultCnt_'] . '条', Url::to(['admin/consultstay']))?></td></tr>
                        <tr><th>退款申请</th><td><?=Html::a($summary['refundmentCnt_'] . '个', Url::to(['admin/refundmentlist']))?></td></tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div style="clear: both">
        <div style="padding:3px 10px 3px 17px; font-size:14px; color:#fff; white-space:nowrap;text-align:center; text-align:left;background-color: #116fb5">
            最新10条等待处理订单
        </div>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'order_no',
                [
                    'label'=>'订单状态',
                    'value'=>function($model){
                        return $model->stat;
                    }
                ],
                [
                    'label'=>'下单用户名',
                    'value'=>function($model){
                        return $model->user->username;
                    }
                ],
                [
                    'label'=>'商户名称',
                    'value'=>function($model){
                        return $model->shop->true_name;
                    }
                ],

                'create_time',
                [
                    'label'=>'操作',
                    'format' => 'raw',
                    'value' => function($model) {
                        $orderDetail = Html::a('订单详情', Url::to(['admin/orderinfo', 'id'=>$model->id]));
                        $appointDetail = Html::a('预约详情', "#");
                        return "$orderDetail|$appointDetail";
                    }
                ]
            ],
        ]); ?>
    </div>
</div>
<script type='text/javascript'>
</script>


