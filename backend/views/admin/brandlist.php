<?php
use yii\helpers\Html;
use yii\grid\GridView;
use \yii\helpers\Url;
use \backend\models\seller\Goods;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<!--Show seller info-->
<div class="sellerinfo">
    <div class="info_bar">
        <b>品牌列表</b>
    </div>
    <div class="blank"></div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'=>$searchModel,
        'columns' => [
            'name',
            [
                'label'=>'类型',
                'attribute'=>'type',
                'filter'=> \backend\models\seller\Brand::getTypetextArr(),
                'value'=>function($model){
                    // Brand and good have the same type
                    $arr = \backend\models\seller\Brand::getTypetextArr();
                    if(isset($model->type)){
                        return $arr[$model->type];
                    }
                    return $model->type;
                },
            ],
            [
                'label'=>'操作',
                'format'=>'raw',
                'value'=>function($model){
                    $edit = Html::a('修改', Url::to(['admin/editbrand', 'id'=>$model->id]));
                    $del = Html::a('删除', Url::to(['admin/delbrand', 'id'=>$model->id]));
                    return "$edit|$del";
                }
            ]
        ],
    ]); ?>
</div>


