<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<!--Show seller info-->
<div class="sellerinfo">
    <div class="info_bar"><b>退款列表</b></div>
    <div class="blank"></div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'order_no',
            'time',
            [
                'label'=>'退款商品名称',
                'format'=>'raw',
                'value'=> function($model){
                    $name = $model->order->appointinfo->good->name;
                    $href = Yii::$app->params['fUrl'] . "site/goodinfo&id=" . $model->order->appointinfo->good->id;
                    return Html::a("$name", $href) ;
                }
            ],
            [
                'label'=>'状态',
                'value'=>function($model){
                    return $model->status;
                }
            ],
            [
                'label'=>'操作',
                'format'=>'raw',
                'value'=>function($model){
                    return Html::a('查看', Url::to(['shop-seller/refundmentinfo', 'id'=>$model->id]));
                }
            ],
        ],
    ]); ?>
</div>

