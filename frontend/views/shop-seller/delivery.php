<?php
use yii\helpers\Html;
use yii\grid\GridView;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<!--Show seller info-->
<div class="sellerinfo">
    <div class="info_bar"><b>系统配送方式</b></div>
    <div class="blank"></div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['label'=>'配送方式', 'value'=>function($model){
                return $model->name;
            }],
            ['label'=>'物流报价', 'value'=>function($model){
                if(0 == $model->is_save_price){
                    return '否';
                } else {
                    return '是';
                }
            }],
            ['label'=>'货到付款', 'value'=>function($model){
                if(1 == $model->type){
                    return '是';
                } else {
                    return '否';
                }
            }],
            ['label'=>'是否配置', 'value'=>function($model){
                $data = $model->sellerDeliveryExtend;
                if($data){
                    return '已配置';
                } else {
                    return '未配置';
                }
            }],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
            ],
        ],
    ]); ?>
</div>

