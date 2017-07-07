<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<!--Show seller info-->
<div class="sellerinfo">
    <div class="info_bar"><b>商品评价列表</b></div>
    <div class="blank"></div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'label'=>'评论人',
                'attribute' => 'user_name',
                'value' => 'user.username',
                "headerOptions" => ["width" => "150"],
            ],
            [
                'label'=>'评价商品',
                'attribute' => 'goods_name',
                "headerOptions" => ["width" => "200"],
                'format'=>'raw',
                'value'=>function($model){
                $href = Yii::$app->params['fUrl'] . "site/goodinfo&id=" . $model->goods->id;
                return Html::a($model->goods->name, $href);
            }],
            [
                'attribute' => 'comment_time',
                "headerOptions" => ["width" => "150"],
            ],
            ['label'=>'状态', 'value'=>function($model){
                if(isset($model->recomment_time)){
                    return '已回复';
                } else {
                    return '未回复';
                }
            }],
            ['label'=>'查看', 'format'=>'raw', 'value'=>function($model){
                return Html::a('查看', Url::to(['shop-seller/commentedit', 'id'=>$model->id]));
            }],
        ],
    ]); ?>
</div>

