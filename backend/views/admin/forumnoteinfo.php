<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<!--Show seller info-->
<style type="text/css">
    .form .radio{
        width:30px;
        float:left;
    }
    .form .radio label{
        display:inline;
    }
</style>
<div class="sellerinfo">
    <div class="info_bar"><b>帖子详情</b></div>
    <div class="blank"></div>
    <?= DetailView::widget([
        'model' => $forumnote,
        'template' => '<tr><th style="width: 160px">{label}</th><td>{value}</td></tr>',
        'attributes' => [
            ['label'=>'需求类型', 'value'=>$forumnote->bigtype],
            ['label'=>'所属学科', 'value'=>$forumnote->subtype],
            ['label'=>'所在地区', 'value'=>$forumnote->area],
            ['label'=>'需求标题', 'value'=>$forumnote->title],
            ['label'=>'发布时间', 'value'=>$forumnote->datetime],
            ['label'=>'截止时间', 'value'=>$forumnote->deadline],
            ['label'=>'需求预算', 'value'=>$forumnote->money],
            ['label'=>'邮箱', 'value'=>$forumnote->email],
            ['label'=>'联系电话', 'value'=>$forumnote->telephone],
            ['label'=>'帖子内容', 'format'=>'raw', 'value'=>$forumnote->detail],
        ],
    ]) ?>
    <?=Html::label('回复帖子', null, ['style'=>'color:green'])?>
    <?= \yii\grid\GridView::widget([
        'dataProvider' => $replylist,
        'columns' => [
            'reply_name',
            'reply_detail',
            'reply_datetime',
        ],
    ]); ?>

</div>

