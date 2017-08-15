<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<!--Show seller info-->
<div class="sellerinfo">
    <div class="info_bar"><b>订单列表</b></div>
    <div class="blank"></div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'=>$searchModel,
        'columns' => [
            'order_no',
            [
                'attribute'=>'status',
                'label'=>'订单状态',
                'filter'=>\backend\models\seller\Order::getStatArr(),
                'value'=>function($model){
                    return $model->stat;
                }
            ],
            [
                'attribute'=>'user_name',
                'label'=>'下单用户名',
                'value'=>'user.username',
            ],
            [
                'label'=>'商户名称',
                'value'=>function($model){
                    return $model->shop->true_name;
                }
            ],

            'create_time',
            [
                'label'=>'操作',
                'format' => 'raw',
                'value' => function($model) {
                    $orderDetail = Html::a('订单详情', Url::to(['admin/orderinfo', 'id'=>$model->id]));
                    return "$orderDetail";
                    //$appointDetail = Html::a('预约详情', "#");
                    //return "$orderDetail|$appointDetail";
                }
            ]
        ],
    ]); ?>
</div>

