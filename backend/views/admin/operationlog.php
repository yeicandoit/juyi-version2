<?php
use yii\helpers\Html;
use yii\grid\GridView;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<!--Show seller info-->
<div class="sellerinfo">
    <div class="info_bar"><b>操作历史</b></div>
    <div class="blank"></div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'user_id',
            'operation_type',
            'operation_time',
        ],
    ]); ?>
</div>
