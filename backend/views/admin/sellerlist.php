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
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
            ],
            'id',
            'seller_name',
            'true_name',
            'mobile',
            'grade',
            'create_time',
            [
                'label'=>'状态',
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
                    return "$edit|";
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


