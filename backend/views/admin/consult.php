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
                $href = Yii::$app->params['fUrl'] . "site/goodinfo&id=" . $model->good->id;
                return Html::a($model->good->name, $href);
            }],
            ['label'=>'状态', 'value'=>function($model){
                if(isset($model->answer)){
                    return '已回复';
                } else {
                    return '未回复';
                }
            }],
            ['label'=>'删除状态', 'format'=>'raw', 'value'=>function($model){
                if($model->del){
                    return  Html::label('已删', '', ['style'=>"color:red"]);
                } else {
                    return '未删';
                }
            }],
            ['label'=>'查看', 'format'=>'raw', 'value'=>function($model){
                $check = Html::a('查看', Url::to(['admin/consultinfo', 'id'=>$model->id, 'type'=>'check']));
                if(0 == $model->del) {
                    $op = Html::a('删除', Url::to(['admin/consultinfo', 'id' => $model->id, 'type' => 'delete']));
                } else {
                    $op = Html::a('恢复', Url::to(['admin/consultinfo', 'id' => $model->id, 'type' => 'restore']));
                }
                return "$check|$op";
            }],
        ],
    ]); ?>
</div>

