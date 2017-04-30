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
        $user = $comment->user;
        $goods = $comment->goods;
        $cgood = Html::a($goods->name, '');
    ?>
    <?= DetailView::widget([
        'model' => $comment,
        'template' => '<tr><th style="width: 160px">{label}</th><td>{value}</td></tr>',
        'attributes' => [
            ['label'=>'评论人', 'value'=>$user->username],
            ['label'=>'评价时间', 'value'=>$comment->time],
            ['label'=>'评价商品', 'format'=>'raw', 'value'=>$cgood],
            ['label'=>'评价内容', 'value'=>isset($comment->contents)?$comment->contents:''],
            ['label'=>'评价分数', 'value'=>$comment->point],
        ],
    ]) ?>
    <?php $form = ActiveForm::begin([]); ?>
    <?= $form->field($comment, 'id', ['options'=>['style'=>'display:none']]);?>
    <?= $form->field($comment, 'recontents')->textarea(['style'=>'width:300px']);?>
    <?= Html::submitButton('确定', [ 'style' => 'width:50px']) ?>
    <?= Html::resetButton('重置', [ 'style' => 'width:50px']) ?>
    <?php ActiveForm::end(); ?>
</div>

