<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use \backend\models\seller\RefundmentDoc;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<!--Show seller info-->
<div class="sellerinfo">
    <div class="info_bar"><b>退款列表</b></div>
    <div class="blank"></div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'=>$searchModel,
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
                'attribute'=>'pay_status',
                'label'=>'状态',
                'filter'=>RefundmentDoc::getStatArr(),
                'value'=>function($model){
                    return $model->status;
                }
            ],
            [
                'label'=>'操作',
                'format'=>'raw',
                'value'=>function($model){
                    $check =  Html::a('查看', Url::to(['admin/refundmentinfo', 'id'=>$model->id]));
                    if($model->pay_status == RefundmentDoc::REFUND_AGREE) {
                        $refund = Html::a('退款', Url::to(['admin/refundment', 'id'=>$model->id]));
                        return "$check|$refund";
                    }

                    return $check;
                }
            ],
        ],
    ]); ?>
</div>

