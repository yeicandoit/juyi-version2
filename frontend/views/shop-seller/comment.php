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
    <div class="info_bar"><b>商品评价列表</b></div>
    <div class="blank"></div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['label'=>'评论人', 'value'=>function($model){
                return $model->user->username;
            }],
            ['label'=>'评价商品', 'format'=>'raw', 'value'=>function($model){
                return Html::a($model->goods->name, '');
            }],
            ['label'=>'评价时间', 'value'=>function($model){
                return $model->time;
            }],
            ['label'=>'状态', 'value'=>function($model){
                if($model->recomment_time > 0){
                    return '已回复';
                } else {
                    return '未回复';
                }
            }],
            ['label'=>'查看', 'format'=>'raw', 'value'=>function($model){
                return Html::a('查看', "/index.php?r=shop-seller/commentedit&id=$model->id");
            }],
        ],
    ]); ?>
</div>

