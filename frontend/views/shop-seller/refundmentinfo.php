<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;
?>
<?=Html::cssFile('@web/css/sellerhome.css')?>
<?=Html::cssFile('@web/css/reg.css')?>
<div class="menuInfo">
    <?php foreach($menu as $item=>$subMenu){?>
        <div class="box">
            <div class="smenu"><h5><?php echo isset($item)?$item:"";?></h5></div>
            <div class="cont">
                <ul class="list">
                    <?php foreach($subMenu as $moreKey => $moreValue){?>
                        <li><a target="_blank"  href="<?php echo $moreValue;?>"><?php echo isset($moreKey)?$moreKey:"";?></a></li>
                    <?php }?>
                </ul>
            </div>
        </div>
    <?php }?>
</div>
<!--Show seller info-->
<div class="sellerinfo">
    <div class="info_bar"><b>商品退款详情</b></div>
    <div class="blank"></div>
    <?php
        $orderFee = \app\models\CountSum::countSellerOrderFee(array($refundment->order));
        $refundAmount = 0;
        $order_goods = $refundment->shopOrderGoods;
        $refgoods = '';
        foreach ($order_goods as $key=>$item) {
            $goods = json_decode($item->goods_array);
            $refundAmount += $item->goods_nums * $item->real_price;
            $refundment->amount = $refundAmount;
            $goodsName = $goods['name'];
            if($goodsName) {
                $refgoods += "<p>
                    $goodsName X $item->goods_nums
                    <span class=\"green\">【$item->goodsSendStatus()】</span>
                    <span class=\"red\">【商品金额：￥$item->goods_nums * $item->real_price>】</span>
                </p>";
            }
        }
        $isWrite = ($refundment->pay_status == 0 && $refundment->isSellerRefund() == 2) ? true : false;
    ?>
    <?= DetailView::widget([
        'model' => $refundment,
        'template' => '<tr><th style="width: 160px">{label}</th><td>{value}</td></tr>',
        'attributes' => [
            'order_no',
            ['label'=>'下单时间', 'value'=>$refundment->order->create_time],
            ['label'=>'订单商品应付金额', 'value'=>$refundment->order->payable_amount],
            ['label'=>'订单商品实付金额', 'value'=>$refundment->order->real_amount],
            ['label'=>'订单运费应付金额', 'value'=>$refundment->order->payable_freight],
            ['label'=>'订单运费实付金额', 'value'=>$refundment->order->real_freight],
            ['label'=>'订单保价金额', 'value'=>$refundment->order->insured],
            ['label'=>'订单促销活动优惠金额', 'value'=>$refundment->order->promotions],
            ['label'=>'订单总额', 'value'=>$refundment->order->order_amount],
            ['label'=>'订单已退金额', 'value'=>$orderFee['refundFee']],
            ['label'=>'退款商品', 'value'=>$refgoods],
            ['label'=>'此退款单已退款金额', 'value'=>$refundment->amount],
            ['label'=>'退款原因', 'value'=>$refundment->content],
        ],
    ]) ?>

    <!--TODO if($isWrite == true), Update refundment info correctly. Now hide ActiveForm-->
    <?php if($isWrite) {?>
        <?php $form = ActiveForm::begin([
            'options' => ['class'=>'form-signin, form-horizontal', 'style'=>'padding-left: 20px; display:none'],
            'fieldConfig' => [
                'template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div><div style=\"float:left;\">{input}</div>
                <div style='padding-left: 280px;'>{hint}</div><div>{error}</div>",
            ],
        ]); ?>
        <?= $form->field($refundment, 'pay_status')->radioList([2=>"同意", 1=>'拒绝'])->label('处理状态')?>
        <?= $form->field($refundment, 'amount')->textInput()->hint('退款商品的总额【单价X数量】')?>
        <?= $form->field($refundment, 'dispose_idea')->textarea(['style'=>'width:300px']);?>

        <?= Html::submitButton('确定', [ 'style' => 'width:50px']) ?>
        <?= Html::resetButton('重置', [ 'style' => 'width:50px']) ?>
    <?php ActiveForm::end(); ?>
    <?php} else{ ?>
        <?= DetailView::widget([
            'model' => $refundment,
            'template' => '<tr><th style="width: 160px">{label}</th><td>{value}</td></tr>',
            'attributes' => [
                ['label'=>'处理状态', 'value'=>$refundment->refundmentText()],
                ['label'=>'处理时间', 'value'=>isset($refundment->dispose_time) ? $refundment->dispose_time : ''],
                ['label'=>'处理意见', 'value'=>isset($refundment->dispose_idea) ? $refundment->dispose_idea : ''],
            ],
        ]) ?>
    <?php } ?>
</div>

