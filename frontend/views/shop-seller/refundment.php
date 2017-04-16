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
    <div class="info_bar"><b>退款列表</b></div>
    <div class="blank"></div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'order_no',
            'time',
            [
                'label'=>'退款商品名称',
                'format'=>'raw',
                'value'=> function($model){
                    $myHtml = '';
                    foreach ($model->shopOrderGoods as $key=>$item){
                        $goods = $item->goods;
                        $myHtml = $myHtml . '<p>'.Html::a("$goods->name", 'javascript:void(0)') .'</p>';
                        return $myHtml;
                    }
                }
            ],
            [
                'label'=>'状态',
                'value'=>function($model){
                    return $model->refundmentText();
                }
            ],
            [
                'label'=>'操作',
                'format'=>'raw',
                'value'=>function($model){
                    return Html::a('查看', "/index.php?r=shop-seller/refundmentinfo&id=$model->id");
                }
            ],
        ],
    ]); ?>
</div>

