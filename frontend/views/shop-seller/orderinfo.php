<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\seller\Areas;
use yii\bootstrap\ActiveForm;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<!--Show seller info-->
<div class="sellerinfo">
    <div class="info_bar"><b>订单查看</b>
        <span style="float: right"><?=Html::a('<b>&nbsp;&nbsp;订单附言</b>', 'javascript:select_tab("6")')?></span>
        <span style="float: right"><?=Html::a('<b>&nbsp;&nbsp;订单备注</b>', 'javascript:select_tab("4")')?></span>
        <span style="float: right"><?=Html::a('<b>&nbsp;&nbsp;收退款记录</b>', 'javascript:select_tab("2")')?></span>
        <span style="float: right"><?=Html::a('<b>&nbsp;&nbsp;基本信息</b>', 'javascript:select_tab("1")')?></span>
    </div>
    <div class="module_content" id="tab-1">
        <?php if(7 != $order->status &&
            6 != $order->status &&
            5 != $order->status &&
            //Have sent test data and not need to send sample
            !(4 == $order->status && (0 == $order->sendbackornot || null == $order->sendbackornot))) {?>
            <div class="blank"></div>
            <label style="color: #985f0d; padding-left: 10px">订单设置</label>
            <div style="border: 1px groove #e8e8e8; padding-left: 10px">
                <?php
                    if(1 == $order->status || 2 == $order->status){
                        $action = '收到买家样品？';
                        $stat = 3;
                    } else if(3 == $order->status) {
                        $action = '已经发送给买家测试数据？';
                        $stat = 4;
                    } else if(4 == $order->status) {
                        $action = '已向买家寄回样品？';
                        $stat = 5;
                    }
                ?>
                <?php $form = ActiveForm::begin([]); ?>
                <div style="display: none"><?= $form->field($order, 'id')?></div>
                <div style="display: none"><?= $form->field($order, 'status')->textInput(['value'=>$stat])?></div>
                <b style="color: green;"><?=$action?></b>
                <?= Html::submitButton('确定', ['class'=>'btn btn-primary']) ?>
                <?php ActiveForm::end(); ?>
            </div>
        <?php } ?>
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

    <div class="module_content" id = 'tab-4' style="display: none;">
        <div class="blank"></div>
        <?php $form = ActiveForm::begin([]); ?>
        <div style="display: none"><?= $form->field($order, 'id')?></div>
        <?= $form->field($order, 'note', [])->textarea(['rows'=>3, 'style'=>'width:350px'])->label('订单备注')?>
        <?= Html::submitButton('保存', ['style' => 'width:50px', 'class'=>'btn btn-primary']) ?>
        <?= Html::resetButton('取消', ['style' => 'width:50px', 'class'=>'btn btn-primary']) ?>
        <?php ActiveForm::end(); ?>
    </div>

    <div class="module_content" id = 'tab-6' style="display: none;">
        <div class="blank"></div>
        <label>订单附言</label>
        <div class="box"><?= $order->postscript ?></div>
    </div>
</div>
<script>
    function select_tab(curr_tab)
    {
        $("div.module_content").hide();
        $("#tab-"+curr_tab).show();
    }
</script>

