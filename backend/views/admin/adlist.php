<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use backend\models\admin\AdManage;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<!--Show seller info-->
<div class="sellerinfo">
    <div class="info_bar"><b>广告列表</b></div>
    <div class="blank"></div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'name',
            [
                'attribute' => 'type',
                'label'=>'广告类型',
                'format'=>'raw',
                "headerOptions" => ["width" => "100"],
                'filter' => AdManage::getTypes(),
                'value'=>function($model){
                    return AdManage::getTypes()[$model->type];
                }
            ],
            [
                'attribute' => 'position_id',
                'label'=>'广告位',
                'format'=>'raw',
                "headerOptions" => ["width" => "100"],
                'value'=>function($model){
                    return $model->position->name;
                }
            ],
            'start_time',
            'end_time',
            [
                'label'=>'操作',
                'format'=>'raw',
                'value'=>function($model){
                    $edit = Html::a('修改', Url::to(['admin/ad', 'id'=>$model->id]));
                    $del = Html::a('删除', Url::to(['admin/delad', 'id'=>$model->id]));
                    return "$edit|$del";
                }
            ]
        ],
    ]); ?>
</div>
<script type="text/javascript">
    function updateStatus(id, val)
    {
        $.get("<?= Url::to(['admin/adposstat'])?>?id="+id+"&val="+val+"&type=status",function(data){
            if('OK' == data){
                alert("设置成功");
            } else {
                alert("设置失败");
            }
        });
    }

    function updateFashion(id, val)
    {
        $.get("<?= Url::to(['admin/adposstat'])?>?id="+id+"&val="+val+"&type=fashion",function(data){
            if('OK' == data){
                alert("设置成功");
            } else {
                alert("设置失败");
            }
        });
    }
</script>

