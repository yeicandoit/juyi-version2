<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<!--Show seller info-->
<div class="sellerinfo">
    <div class="info_bar"><b>概要信息</b></div>
    <div class="blank"></div>
    <div>
        商品总数量：<b class="blue"><?=Html::a($summary['goodsCnt'] . '件',Url::to(['shop-seller/goodslist']))?></b>
        &nbsp;&nbsp;&nbsp;待回复咨询: <b class="blue">0 条</b>
        &nbsp;&nbsp;&nbsp;商品评论数: <b class="blue"><?=Html::a($summary['commentCnt'] . '条',Url::to(['shop-seller/comment']))?></b>
        &nbsp;&nbsp;&nbsp;预约数: <b class="blue"><?=Html::a($summary['appointCnt'] . '个',Url::to(['shop-seller/appointinfo']))?></b>
        &nbsp;&nbsp;&nbsp;订单数: <b class="blue"><?=Html::a($summary['orderCnt'] . '个',Url::to(['shop-seller/order']))?></b>
        &nbsp;&nbsp;&nbsp;退款申请: <b class="blue"><?=Html::a($summary['refundCnt'] . '条',Url::to(['shop-seller/refundment']))?></b>
    </div>
    <div class="blank"></div>
    <div class="blank"></div>
    <div class="info_bar"><b>销售统计</b></div>
</div>


