<?php
use yii\helpers\Html;
use yii\helpers\Url;
$this->registerJsFile('@web/assets/new/_systemjs/highcharts/highcharts.js', ['depends' => ['backend\assets\AppAsset'], 'position' => $this::POS_HEAD]);
?>
<!--Show seller info-->
<div class="sellerinfo">
    <div class="info_bar"><b>概要信息</b></div>
    <div class="blank"></div>
    <div>
        商品总数量：<b class="blue"><?=Html::a($summary['goodsCnt'] . '件',Url::to(['shop-seller/goodslist']))?></b>
        &nbsp;&nbsp;&nbsp;待回复咨询: <b class="blue">0 条</b>
        &nbsp;&nbsp;&nbsp;商品评论数: <b class="blue"><?=Html::a($summary['commentCnt'] . '条',Url::to(['shop-seller/comment']))?></b>
        <?php if(isset($summary['appointCnt'])){?>
            &nbsp;&nbsp;&nbsp;预约数: <b class="blue"><?=Html::a($summary['appointCnt'] . '个',Url::to(['shop-seller/appointinfo']))?></b>
        <?php }?>
        &nbsp;&nbsp;&nbsp;订单数: <b class="blue"><?=Html::a($summary['orderCnt'] . '个',Url::to(['shop-seller/order']))?></b>
        &nbsp;&nbsp;&nbsp;退款申请: <b class="blue"><?=Html::a($summary['refundCnt'] . '条',Url::to(['shop-seller/refundment']))?></b>
    </div>
    <div class="blank"></div>
    <div class="blank"></div>
    <div class="info_bar"><b>销售统计</b></div>
    <div id="myChart" style="width:100%;min-height:320px;">
</div>
<script type='text/javascript'>
    //图表生成
    $(function()
    {
        //图标模板
        userHighChart = $('#myChart').highcharts(
            {
                title:
                {
                    text:'销售额统计'
                },
                xAxis:
                {
                    title:
                    {
                        text:'时间'
                    },
                    categories:<?php echo json_encode(array_keys($countData));?>,
                },
                yAxis:
                {
                    title:
                    {
                        text:'销售额(元)'
                    },
                },
                series:
                    [
                        {
                            name:'销售额',
                            data:<?php echo json_encode(array_values($countData));?>
                        }
                    ],
                tooltip:
                {
                    valueSuffix:'元'
                }
            });
    })
</script>


