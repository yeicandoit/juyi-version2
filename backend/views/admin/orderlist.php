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
            ['attribute'=>'order_no', 'options' => ['width' => "100"]],
            [
                'attribute'=>'status',
                "headerOptions" => ["width" => "100"],
                'label'=>'订单状态',
                'filter'=>\backend\models\seller\Order::getStatArr(),
                'value'=>function($model){
                    return $model->stat;
                }
            ],
            [
                'attribute'=>'order_type',
                'label'=>'订单类型',
                'options' => ['width' => "100"],
                'filter'=>\backend\models\seller\Order::getOrderTypeArr(),
                'value'=>function($model){
                    return $model->orderType;
                }
            ],
            [
                'attribute'=>'user_name',
                'label'=>'下单用户名',
                'options' => ['width' => "100"],
                "headerOptions" => ["width" => "100"],
                'value'=>'user.username',
            ],
            [
                'label'=>'商户名称',
                'options' => ['width' => "80"],
                'value'=>function($model){
                    return $model->shop->true_name;
                }
            ],

            ['attribute'=>'create_time', 'contentOptions' => ['style' => 'white-space: normal;', 'width' => '100'],],
            [
                'label'=>'操作',
                'options' => ['width' => "100"],
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

