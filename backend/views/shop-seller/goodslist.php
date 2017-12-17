<?php
use yii\helpers\Html;
use yii\grid\GridView;
use \yii\helpers\Url;
use \backend\models\admin\OperationLog;
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
                'attribute'=>'name',
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
            [
                'attribute'=>'goods_no',
                'options' => ['width' => "80"],
                'format'=>'raw',
                'value'=> function($model){
                    $addTime = OperationLog::find()->where(['table_name'=>'jy_goods', 'element_id'=>$model->id,
                        'operation_type'=>'add'])->min('operation_time');
                    $editTime = OperationLog::find()->where(['table_name'=>'jy_goods', 'element_id'=>$model->id,
                        'operation_type'=>'edit'])->max('operation_time');
                    $operationLog = "";
                    if(isset($addTime)){
                        $operationLog .= "<br>添加时间：$addTime";
                    }
                    if(isset($editTime)){
                        $operationLog .= "<br>最近修改：$editTime";
                    }
                    return "$model->goods_no$operationLog";
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
            ['attribute' => 'sell_price', 'options' => ['width' => "80"],],
            [
                'attribute' => 'is_del',
                'label'=>'状态',
                'format'=>'raw',
                "headerOptions" => ["width" => "100"],
                'filter' => \backend\models\seller\Goods::getStat(),
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


