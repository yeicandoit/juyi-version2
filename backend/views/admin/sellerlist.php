<?php
use yii\helpers\Html;
use yii\grid\GridView;
use \yii\helpers\Url;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<!--Show seller info-->
<div class="sellerinfo">
    <div class="info_bar">
        <b>商家列表</b>
    </div>
    <div class="blank"></div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'=>$searchModel,
        'columns' => [
            ['attribute'=>'id',  'options' => ['width' => "120"]],
            ['attribute'=>'seller_name', 'options' => ['width' => "100"],'label'=>'登录名'],
            'true_name',
            ['attribute'=>'mobile', 'options' => ['width' => "120"]],
            ['attribute'=>'grade','options' => ['width' => "80"]],
            ['attribute'=>'create_time', 'contentOptions' => ['style' => 'white-space: normal;', 'width' => '100'],],
            [
                'label'=>'状态',
                'attribute'=>'is_del',
                'filter'=>array(0=>'正常', 1=>'待审'),
                'format'=>'raw',
                'value'=>function($model){
                    $arr = array(
                        0 => '正常',
                        1=> '待审',
                    );
                    return Html::dropDownList('', null, $arr,
                        ['options'=>[$model->is_del=>['selected'=>1]], 'onchange'=>"updateStatus($model->id, this.value)"]
                    );
                }
            ],
            [
                'label'=>'操作',
                'format'=>'raw',
                'value'=>function($model){
                    $edit = Html::a('概况', Url::to(['admin/sellerinfo', 'id'=>$model->id]));
                    $detail = Html::a('详情', Url::to(['admin/shopdetail', 'id'=>$model->id, 'type'=>'seller']));
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


