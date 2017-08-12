<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<!--Show seller info-->
<div class="sellerinfo">
    <div class="info_bar"><b>帖子列表</b></div>
    <div class="blank"></div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'=>$searchModel,
        'columns' => [
            'title',
            'author',
            'bigtype',
            'subtype',
            'datetime',
            [
                'label'=>'操作',
                'format' => 'raw',
                'value' => function($model) {
                    $view = Html::a('查看', Url::to(['admin/forumnoteinfo', 'id'=>$model->id]));
                    $del = Html::a('删除',  Url::to(['admin/delforumnote', 'id'=>$model->id]));
                    return "$view|$del";
                }
            ]
        ],
    ]); ?>
</div>

