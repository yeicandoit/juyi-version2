<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use backend\models\seller\Message;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<!--Show seller info-->
<div class="sellerinfo">
    <div class="info_bar"><b>消息列表</b></div>
    <div class="blank"></div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'title', 
            'time',
            [
                'label'=>'类型',
                'attribute'=>'type',
                'filter'=>Message::getTypes(),
                'value'=>function($model){
                    return Message::getTypes()[$model->type]; 
                }
            ],
            ['label'=>'查看', 'format'=>'raw', 'value'=>function($model){
                $edit = Html::a('查看', Url::to(['admin/message', 'id'=>$model->id]));
                $del = Html::a('删除', Url::to(['admin/delmessage', 'id'=>$model->id]));
                return "$edit|$del";
            }],
        ],
    ]); ?>
</div>

