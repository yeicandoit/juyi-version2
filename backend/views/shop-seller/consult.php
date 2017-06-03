<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<!--Show seller info-->
<div class="sellerinfo">
    <div class="info_bar"><b>商品咨询列表</b></div>
    <div class="blank"></div>
    <?= GridView::widget([
        'dataProvider' => $consult,
        'columns' => [
            ['label'=>'咨询商品', 'format'=>'raw', 'value'=>function($model){
                return Html::a($model->good->name, '');
            }],
            ['label'=>'状态', 'value'=>function($model){
                if(isset($model->answer)){
                    return '已回复';
                } else {
                    return '未回复';
                }
            }],
            ['label'=>'查看', 'format'=>'raw', 'value'=>function($model){
                return Html::a('查看', Url::to(['shop-seller/consultinfo', 'id'=>$model->id]));
            }],
        ],
    ]); ?>
</div>

