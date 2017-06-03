<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<!--Show seller info-->
<div class="sellerinfo">
    <div class="info_bar"><b>商品评价回复</b></div>
    <div class="blank"></div>
    <?php
        $good = $consult->good;
        $cgood = Html::a($good->name, '');
    ?>
    <?= DetailView::widget([
        'model' => $consult,
        'template' => '<tr><th style="width: 160px">{label}</th><td>{value}</td></tr>',
        'attributes' => [
            ['label'=>'咨询商品', 'format'=>'raw', 'value'=>$cgood],
            'question',
        ],
    ]) ?>
    <?php $form = ActiveForm::begin([]); ?>
    <?= $form->field($consult, 'id', ['options'=>['style'=>'display:none']]);?>
    <?= $form->field($consult, 'answer')->textarea(['style'=>'width:300px'])->label('回答');?>
    <?= Html::submitButton('确定', [ 'style' => 'width:50px', 'class'=>'btn btn-primary']) ?>
    <?= Html::resetButton('重置', [ 'style' => 'width:50px', 'class'=>'btn btn-primary']) ?>
    <?php ActiveForm::end(); ?>
</div>

