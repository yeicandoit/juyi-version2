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
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
            ],
            'id',
            'name',
            'true_name',
            'mobile',
            'grade',
            'regedittime',
            [
                'label'=>'操作',
                'format'=>'raw',
                'value'=>function($model){
                    $edit = Html::a('概况', Url::to(['admin/expertinfo', 'id'=>$model->id]));
                    $detail = Html::a('详情', Url::to(['admin/shopdetail', 'id'=>$model->id, 'type'=>'expert']));
                    return "$edit|$detail";
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


