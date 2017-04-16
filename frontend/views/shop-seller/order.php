<?php
use yii\helpers\Html;
use yii\grid\GridView;
?>
<?=Html::cssFile('@web/css/sellerhome.css')?>
<?=Html::cssFile('@web/css/reg.css')?>
<div class="menuInfo">
    <?php foreach($menu as $item=>$subMenu){?>
        <div class="box">
            <div class="smenu"><h5><?php echo isset($item)?$item:"";?></h5></div>
            <div class="cont">
                <ul class="list">
                    <?php foreach($subMenu as $moreKey => $moreValue){?>
                        <li><a target="_blank"  href="<?php echo $moreValue;?>"><?php echo isset($moreKey)?$moreKey:"";?></a></li>
                    <?php }?>
                </ul>
            </div>
        </div>
    <?php }?>
</div>
<!--Show seller info-->
<div class="sellerinfo">
    <div class="info_bar"><b>订单列表</b></div>
    <div class="blank"></div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'order_no',
            ['label'=>'收货人', 'value'=>function($model){
                return $model->accept_name;
            }],
            'mobile',
            ['label'=>'配送状态','value'=> function($model){
                if(1 == $model->distribution_status) {
                    return '已发货';
                } else if (0 == $model->distribution_status) {
                    return '未发货';
                }  else if (2 == $model->distribution_status) {
                    return '部分发货';
                } else if (5 == $model->distribution_status) {
                    return '已收货';
                }
            }],
            ['label'=>'支付状态', 'value'=>function($model){
                return $model->getOrderPayStatusText($model->pay_status);
            }],
            'create_time',
            [
                'label'=>'操作',
                'format' => 'raw',
                'value' => function($model) {
                    if($model->isGoDelivery()){
                        return Html::a('发货', '/index.php?r=site/') . "|" . "查看详情";
                    } else {
                        return Html::a('查看详情', "/index.php?r=shop-seller/orderinfo&id=$model->id");
                    }
                }
            ]

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

