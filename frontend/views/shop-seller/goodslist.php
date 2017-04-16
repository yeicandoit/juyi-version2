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
        <b>商品列表</b>
    </div>
    <div class="blank"></div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
            ],
            [
                'label'=>'商品名称',
                'format'=>'raw',
                'value'=> function($model){
                    return "<table>
                                   <tr>
                                   <td><a href=''><img class='user_fav_img' src='/images/user_ico.gif'/></a></td>
                                   <td>$model->name</td>
                                   </tr>
                                </table>";
                }
            ],
            [
                'label'=>'分类',
                'format'=>'raw',
                'value'=>function($model){
                    $catName = array();
                    foreach($model->shopCategoryExtends as $key=>$catExt){
                        $catName[] = $catExt->category->name;
                    }
                    $strCats = join(',',$catName);
                    return "<div style='max-width: 250px;white-space: normal;'>$strCats</div>";
                }
            ],
            'sell_price',
            'store_nums',
            [
                'label'=>'状态',
                'format'=>'raw',
                'value'=>function($model){
                    $color = $model->is_del==0 ? 'grenn':'red';
                    return Html::label($model->statusText(), '', ['style'=>"color:$color"]);
                }
            ],
            [
                'label'=>'操作',
                'format'=>'raw',
                'value'=>function($model){
                    $edit = Html::a('修改', '/index.php?r=shop-seller/goodsedit&id='.$model->id);
                    $del = Html::a('删除', '/index.php?r=shop-seller/goodsstat&id='.$model->id.'&status='.'1');
                    $down = Html::a('下架', '/index.php?r=shop-seller/goodsstat&id='.$model->id.'&status='.'2');
                    $up = Html::a('提交审核', '/index.php?r=shop-seller/goodsstat&id='.$model->id.'&status='.'3');
                    return "$edit|$del|$down|$up";
                }
            ]
        ],
    ]); ?>
</div>


