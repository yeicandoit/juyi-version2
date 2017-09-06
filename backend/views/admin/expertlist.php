<?php
use yii\helpers\Html;
use yii\grid\GridView;
use \yii\helpers\Url;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<!--Show seller info-->
<div class="sellerinfo">
    <div class="info_bar">
        <b>专家列表</b>
    </div>
    <div class="blank"></div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'=>$searchModel,
        'columns' => [
            ['attribute'=>'id',  'options' => ['width' => "80"]],
            'name',
            'true_name',
            ['attribute'=>'mobile', 'options' => ['width' => "120"]],
            ['attribute'=>'grade', 'options' => ['width' => "80"]],
            'regedittime',
            [
                'label'=>'操作',
                'format'=>'raw',
                'value'=>function($model){
                    $edit = Html::a('概况', Url::to(['admin/expertinfo', 'id'=>$model->id]));
                    $detail = Html::a('详情', Url::to(['admin/shopdetail', 'id'=>$model->id, 'type'=>'expert']));
                    $goods = Html::a('商品', Url::to(['admin/goodslist', 'GoodsSearch[seller_id]'=>$model->id]));
                    return "$edit|$detail|$goods";
                }
            ]
        ],
    ]); ?>
</div>
<script type="text/javascript">
    function updateStatus(id, val)
    {
        $.get("<?= Url::to(['admin/sellerstat'])?>&id="+id+"&status="+val,function(data){});
    }
</script>


