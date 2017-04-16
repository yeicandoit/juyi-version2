<?php
use yii\helpers\Html;
use yii\grid\GridView;
?>
<?=Html::cssFile('@web/css/sellerhome.css')?>
<?=Html::cssFile('@web/css/reg.css')?>
<div class="menuInfo">
    <?php foreach($menu as $item=>$subMenu){?>
        <div class="box">
            <div class="smenu"><h5><?php echo isset($item)?$item:"";?></h5></div>
            <div class="cont">
                <ul class="list">
                    <?php foreach($subMenu as $moreKey => $moreValue){?>
                        <li><a target="_blank"  href="<?php echo $moreValue;?>"><?php echo isset($moreKey)?$moreKey:"";?></a></li>
                    <?php }?>
                </ul>
            </div>
        </div>
    <?php }?>
</div>
<!--Show seller info-->
<div class="sellerinfo">
    <div class="info_bar">
        <b>规格列表</b>
    </div>
    <div class="blank"></div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'name',
            [
                'label'=>'规格数据',
                'value'=>function($model) {
                    $specValue = '';
                    $specJsonValue = json_decode($model->value);
                    if($specJsonValue){
                        foreach ($specJsonValue as $key => $rs) {
                            if ($model->type == 1) {
                                $v = isset($rs) ? $rs : '';
                                $specValue .= "[$v]";
                            }
                        }
                    }
                    return $specValue;
                }
            ],
            [
                'label'=>'操作',
                'format'=>'raw',
                'value'=>function($model){
                    $edit = Html::a('修改', "/index.php?r=shop-seller/specedit&id=$model->id", ['class'=>'btn']);
                    $del = Html::a('删除', '', ['class'=>'btn']);
                    return "$edit|$del";
                }
            ],
        ],
    ]); ?>
</div>
