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
        'columns' => [
            ['label'=>'评论人', 'value'=>function($model){
                return $model->user? $model->user->username : '';
            }],
            ['label'=>'评价商品', 'format'=>'raw', 'value'=>function($model){
                return Html::a($model->goods->name, '');
            }],
            'comment_time',
            ['label'=>'状态', 'value'=>function($model){
                if(isset($model->recomment_time)){
                    return '已回复';
                } else {
                    return '未回复';
                }
            }],
            ['label'=>'查看', 'format'=>'raw', 'value'=>function($model){
                return Html::a('查看', Url::to(['admin/commentedit', 'id'=>$model->id]));
            }],
        ],
    ]); ?>
</div>

