<?php
use yii\helpers\Html;
use yii\grid\GridView;
use \yii\helpers\Url;
use backend\models\seller\Goods;
use backend\models\admin\CommendGoods;
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
                'attribute' => 'name',
                'label'=>'商品名称',
                'options' => ['width' => "200"],
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
                //"headerOptions" => ["width" => "50"],
                'options' => ['width' => "80"],
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
                    $hot = '';
                    if($model->goodtype == Goods::TYPE_TEST){
                        $type = CommendGoods::HotDevice;
                        if(CommendGoods::findOne(['commend_id'=>$model->id, 'type'=>$type])){
                            $hot =  Html::a('<font color="#8a2be2">删除热门</font>', '#', ['onclick'=>"delhot('$model->goods_no', '$type', $model->id)"]);
                        } else {
                            $hot = Html::a('添加热门', '#', ['onclick'=>"addhot('$model->goods_no', '$type', $model->id)"]);
                        }
                        return "$edit|<ctrl id='ctrl$model->id'>$hot</ctrl>";
                    }
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

    function addhot(hot, mtype, id)
    {
        $.get("<?=Url::to(['admin/addhot'])?>" + "?hot=" + hot + "&type=" + mtype, function (data) {
            if('添加成功' == data){
                $('#ctrl'+id).html('<a href="#" onclick="delhot(\''+hot+'\','+mtype+','+id+')" ><font color="#8a2be2">删除热门</font></a>');
            }  else {
                alert(data);
            }
        });
    }

    function delhot(hot, mtype, id)
    {
        $.get("<?=Url::to(['admin/delhotdevice'])?>" + "?id=" + id, function (data) {
            if('OK' == data){
                $('#ctrl'+id).html('<a href="#" onclick="addhot(\''+hot+'\','+mtype+','+id+')">添加热门</a>');
            } else {
                alert(data);
            }
        });
    }
</script>


