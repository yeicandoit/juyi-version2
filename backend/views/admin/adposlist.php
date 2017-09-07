<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<!--Show seller info-->
<div class="sellerinfo">
    <div class="info_bar"><b>广告位列表</b></div>
    <div class="blank"></div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'name',
            'width',
            'height',
            [
                'attribute' => 'fashion',
                'label'=>'显示方式',
                'format'=>'raw',
                "headerOptions" => ["width" => "100"],
                'filter' => array(1=>'轮显', 2=>'随即'),
                'value'=>function($model){
                    return Html::dropDownList('', null, array(1=>'轮显', 2=>'随即'),
                        ['options'=>[$model->fashion=>['selected'=>1]], 'onchange'=>"updateFashion($model->id, this.value)"]
                    );
                }
            ],
            [
                'attribute' => 'status',
                'label'=>'状态',
                'format'=>'raw',
                "headerOptions" => ["width" => "100"],
                'filter' => array(1=>'开启', 0=>'关闭'),
                'value'=>function($model){
                    return Html::dropDownList('', null, array(1=>'开启', 0=>'关闭'),
                        ['options'=>[$model->status=>['selected'=>1]], 'onchange'=>"updateStatus($model->id, this.value)"]
                    );
                }
            ],
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

