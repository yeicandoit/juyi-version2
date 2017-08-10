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
            ['label'=>'查看', 'format'=>'raw', 'value'=>function($model){
                return Html::a('查看', Url::to(['shop-seller/message', 'id'=>$model->id]));
            }],
        ],
    ]); ?>
</div>

