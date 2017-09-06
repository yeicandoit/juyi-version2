<?php
use yii\helpers\Html;
use yii\grid\GridView;
use \yii\helpers\Url;
use backend\models\seller\Goods;
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
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'name',
                'label'=>'商品名称',
                'format'=>'raw',
                'value'=> function($model){
                    if($model->img){
                        $src = Url::to("@web/" . $model->img);
                    } else {
                        $src = Url::to("@web/images/user_ico.gif");
                    }
                    $href = Yii::$app->params['fUrl'] . "site/goodinfo&id=$model->id";
                    return "<table>
                                   <tr>
                                   <td><a href=$href><img class='user_fav_img' src=$src /></a></td>
                                   <td><div style='max-width: 250px;white-space: normal;'><a href=$href>$model->name</a></div></td>
                                   </tr>
                                </table>";
                }
            ],
            ['attribute'=>'goods_no', 'options' => ['width' => "80"]],
            [
                'label'=>'分类',
                'format'=>'raw',
                'contentOptions' => ['style' => 'white-space: normal;', 'width' => '150'],
                'value'=>function($model){
                    $catName = array();
                    foreach($model->categoryExtends as $key=>$catExt){
                        $catName[] = $catExt->category->name;
                    }
                    $strCats = join(',',$catName);
                    return $strCats;
                }
            ],
            [
                'attribute' => 'sell_price',
                "headerOptions" => ["width" => "80"],
            ],
            [
                'attribute' => 'goodtype',
                'label' => '类型',
                'filter' => Goods::getTypes(),
                'value' => function($model){
                    return isset(Goods::getTypes()[$model->goodtype]) ? Goods::getTypes()[$model->goodtype] : null;
                }
            ],
            [
                'attribute' => 'is_del',
                'label'=>'状态',
                'format'=>'raw',
                "headerOptions" => ["width" => "100"],
                'filter' => Goods::getStat(),
                'value'=>function($model){
                    return Html::dropDownList('', null, $model->stat,
                        ['options'=>[$model->is_del=>['selected'=>1]], 'onchange'=>"updateStatus($model->id, this.value)"]
                    );
                }
            ],
            [
                'label'=>'操作',
                'format'=>'raw',
                'value'=>function($model){
                    $edit = Html::a('修改', Url::to(['admin/goodsedit', 'id'=>$model->id]));
                    return "$edit";
                }
            ]
        ],
    ]); ?>
</div>
<script type="text/javascript">
    function updateStatus(id, val)
    {
        $.get("<?= Url::to(['admin/goodsstat'])?>?id="+id+"&status="+val,function(data){});
    }
</script>


