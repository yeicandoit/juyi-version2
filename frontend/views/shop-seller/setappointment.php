<?php
use yii\helpers\Html;
use yii\grid\GridView;
use \yii\helpers\Url;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<div class="sellerinfo">
    <div class="info_bar">
        <b>选择商品设置预约</b>
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
                                   <td><a href=''><img class='user_fav_img' src=$src/></a></td>
                                   <td>&nbsp;$model->name</td>
                                   </tr>
                                </table>";
                }
            ],
            [
                'label'=>'状态',
                'format'=>'raw',
                'value'=>function($model){
                    if($model->hasSetAppoint()) {
                        return Html::label("已设置预约");
                    } else {
                        return Html::label("未设置预约");
                    }
                }
            ],
            [
                'label'=>'操作',
                'format'=>'raw',
                'value'=>function($model){
                    $add = Html::a('添加', Url::to(['shop-seller/editappointment', 'id'=>$model->id, 'status'=>1]));
                    $edit = Html::a('修改',  Url::to(['shop-seller/editappointment', 'id'=>$model->id, 'status'=>2]));
                    return "$add|$edit";
                }
            ]
        ],
    ]); ?>
</div>

