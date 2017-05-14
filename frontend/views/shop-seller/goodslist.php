<?php
use yii\helpers\Html;
use yii\grid\GridView;
use \yii\helpers\Url;
?>
<?=Html::cssFile('@web/css/reg.css')?>
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
                    if($model->img){
                        $src = $model->img;
                    } else {
                        $src = '/images/user_ico.gif';
                    }
                    return "<table>
                                   <tr>
                                   <td><a href=''><img class='user_fav_img' src=$src /></a></td>
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
                    foreach($model->categoryExtends as $key=>$catExt){
                        $catName[] = $catExt->category->name;
                    }
                    $strCats = join(',',$catName);
                    return "<div style='max-width: 250px;white-space: normal;'>$strCats</div>";
                }
            ],
            'sell_price',
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
                    $edit = Html::a('修改', Url::to(['shop-seller/goodsedit', 'id'=>$model->id]));
                    $del = Html::a('删除', Url::to(['shop-seller/goodsstat', 'id'=>$model->id, 'status'=>1]));
                    $down = Html::a('下架',  Url::to(['shop-seller/goodsstat', 'id'=>$model->id, 'status'=>2]));
                    $up = Html::a('提交审核',  Url::to(['shop-seller/goodsstat', 'id'=>$model->id, 'status'=>3]));
                    return "$edit|$del|$down|$up";
                }
            ]
        ],
    ]); ?>
</div>


