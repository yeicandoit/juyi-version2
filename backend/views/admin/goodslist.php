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
                'label'=>'状态',
                'format'=>'raw',
                'value'=>function($model){
                    $arr = array(
                        0 => '上架',
                        1=> '删除',
                        2=> '下架',
                        3=> '待审',
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
        $.get("<?= Url::to(['admin/goodsstat'])?>&id="+id+"&status="+val,function(data){});
    }
</script>

