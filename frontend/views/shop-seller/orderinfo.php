<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\seller\Areas;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<!--Show seller info-->
<div class="sellerinfo">
    <div class="info_bar"><b>订单查看</b>
        <span style="float: right"><?=Html::a('<b>&nbsp;&nbsp;订单附言</b>', 'javascript:select_tab("6")')?></span>
        <span style="float: right"><?=Html::a('<b>&nbsp;&nbsp;订单日志</b>', 'javascript:select_tab("5")')?></span>
        <span style="float: right"><?=Html::a('<b>&nbsp;&nbsp;订单备注</b>', 'javascript:select_tab("4")')?></span>
        <span style="float: right"><?=Html::a('<b>&nbsp;&nbsp;发货记录</b>', 'javascript:select_tab("3")')?></span>
        <span style="float: right"><?=Html::a('<b>&nbsp;&nbsp;收退款记录</b>', 'javascript:select_tab("2")')?></span>
        <span style="float: right"><?=Html::a('<b>&nbsp;&nbsp;基本信息</b>', 'javascript:select_tab("1")')?></span>
    </div>
    <div class="module_content" id="tab-1">
        <div class="blank"></div>
        <label style="color: #985f0d; padding-left: 10px">订单信息</label>
        <?= DetailView::widget([
            'model' => $order,
            'template' => '<tr><th style="width: 150px">{label}</th><td>{value}</td></tr>',
            'attributes' => [
                'order_no',
                ['label'=>'当前状态', 'value'=>$order->stat],
                ['label'=>'支付状态', 'value'=>$order->payStatus],
                ['label'=>'配送状态', 'value'=>$order->orderDistributionStatusText],
                ['label'=>'订单类型', 'value'=>$order->orderTypeText],
            ],
        ]) ?>
        <div style="border: 1px groove #e8e8e8; padding-left: 10px">
            <table width="100%" cellpadding="0" cellspacing="0" align="center" style="border:10px; solid #123456;">
                <tr>
                    <th>商品名称</th>
                    <th>商品价格</th>
                    <th>商品数量</th>
                    <th>小计</th>
                </tr>
                <tr>
                    <td><a href=''><?=$order->appointinfo->good->name?></a></td>
                    <td>￥<?= $order->appointinfo->good->sell_price?></td>
                    <td>x<?= $order->appointinfo->appointnum?></td>
                    <td>￥<?= $order->appointinfo->appointnum * $order->appointinfo->good->sell_price?></td>
                </tr>
            </table>
        </div>
        <div class="blank"></div>
        <label style="color: #985f0d; padding-left: 10px">买家配送信息</label>
        <?= DetailView::widget([
            'model' => $order,
            'template' => '<tr><th style="width: 150px">{label}</th><td>{value}</td></tr>',
            'attributes' => [
                ['label'=>'快递公司名称', 'value'=>$order->delivery ? $order->delivery->name : ''],
                ['label'=>'快递单号', 'value'=>$order->delivery ? $order->delivery->number : ''],
                ['label'=>'快递补充说明', 'value'=>$order->delivery ? $order->delivery->description  : ''],
            ],
        ]) ?>

        <div class="blank"></div>
        <?php if($order->sendbackornot) {?>
            <label style="color: #985f0d; padding-left: 10px">买家收货信息</label>
            <?php
                //$location = $order->province? Areas::findOne($order->province)->area_name : '' . '-' .
                //    $order->city ? Areas::findOne($order->city)->area_name : '' .  '-'  .
                //    $order->area ? Areas::findOne($order->area)->area_name : '';
                $location = false;
                if($order->province) {
                    $location .= Areas::findOne($order->province)->area_name . '-';
                }
                if($order->city) {
                    $location .= Areas::findOne($order->city)->area_name . '-';
                }
                if($order->area) {
                    $location .= Areas::findOne($order->area)->area_name;
                }
            ?>
            <?= DetailView::widget([
                'model' => $order,
                'template' => '<tr><th style="width: 150px">{label}</th><td>{value}</td></tr>',
                'attributes' => [
                    'accept_name',
                    'mobile',
                    ['label'=>'地区', 'value'=>$location],
                    'address',
                    'postcode',
                    'invoice_title',
                    'send_time',
                ],
            ]) ?>
        <?php }?>
    </div>
</div>
<script>
    function select_tab(curr_tab)
    {
        $("div.module_content").hide();
        $("#tab-"+curr_tab).show();
        //$("ul[name=menu1] > li").removeClass('active');
        //$('#li_'+curr_tab).addClass('active');
    }
    //修改订单价格
    function updateDiscount()
    {
        var order_id = <?=$order->id;?>;
        var discount = $('input[name="discount"]').val();
        $.getJSON("/index.php?r=shop-seller/orderdiscount",{'id':order_id,'discount':discount},function(json)
        {
            if(json.result == true)
            {
                $('#orderAmount').text("￥" + json.orderAmount);
                $('#orderAmount').addClass("red");
                return;
            }
        });
    }
</script>

