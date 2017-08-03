<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<!--Show seller info-->
<div class="sellerinfo">
    <div class="info_bar"><b>商品退款详情</b></div>
    <div class="blank"></div>
    <div>
        <?php $form = ActiveForm::begin([]); ?>
        <?= $form->field($refundment, 'id', ['options'=>['style'=>'display:none']])?>
        <?php if(0 == $refundment->pay_status){ ?>
            <?= $form->field($refundment, 'pay_status')->radioList([1=>"同意", 2=>'拒绝'])->label('申请退款处理')?>
            <?= Html::submitButton('确定', ['class'=>'btn btn-primary']) ?>
        <?php } else if(2 == $refundment->pay_status) {?>
            <b style="color: red;">申请聚仪平台仲裁？</b>
            <?= $form->field($refundment, 'pay_status', ['options'=>['style'=>'display:none']])->textInput(['value'=>3])?>
            <?= Html::submitButton('确定', ['class'=>'btn btn-primary']) ?>
        <?php }?>
        <?php ActiveForm::end(); ?>
        <div class="blank"></div>
    </div>
    <?php
        $appointInfo = $refundment->order->appointinfo;
        $href = Yii::$app->params['fUrl'] . "site/goodinfo&id=" . $appointInfo->good->id;
        $good = Html::a($appointInfo->good->name, $href, []) . ' X ' . $appointInfo->appointnum;
    ?>
    <?= DetailView::widget([
        'model' => $refundment,
        'template' => '<tr><th style="width: 160px">{label}</th><td>{value}</td></tr>',
        'attributes' => [
            ['label'=>'买家姓名', 'value'=>$refundment->user->username],
            'order_no',
            ['label'=>'下单时间', 'value'=>$refundment->order->create_time],
            ['label'=>'订单应付金额', 'value'=>$refundment->order->payable_amount],
            ['label'=>'订单实付金额', 'value'=>$refundment->order->real_amount],
            ['label'=>'退款商品', 'format'=>'raw', 'value'=>$good],
            ['label'=>'已退款金额', 'value'=>$refundment->amount],
            ['label'=>'退款原因', 'value'=>$refundment->content],
        ],
    ]) ?>

    <?= DetailView::widget([
        'model' => $refundment,
        'template' => '<tr><th style="width: 160px">{label}</th><td>{value}</td></tr>',
        'attributes' => [
            ['label'=>'处理状态', 'format'=>'raw', 'value'=>$refundment->status],
            ['label'=>'处理时间', 'value'=>isset($refundment->dispose_time) ? $refundment->dispose_time : ''],
            ['label'=>'处理回复', 'value'=>isset($refundment->dispose_idea) ? $refundment->dispose_idea : ''],
        ],
    ]) ?>
    <div class="blank"></div>

</div>

