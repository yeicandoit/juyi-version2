<?php
use yii\helpers\Html;
use yii\grid\GridView;
use \yii\helpers\Url;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<div class="sellerinfo">
    <div class="info_bar">
        <b>商品预约信息</b>
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
                    if($model->good){
                        $src = $model->good->img;
                    } else {
                        $src = '/images/user_ico.gif';
                    }
                    $name = $model->good->name;
                    return "<table>
                                   <tr>
                                   <td><a href=''><img class='user_fav_img' src=$src /></a></td>
                                   <td>&nbsp;$name</td>
                                   </tr>
                                </table>";
                }
            ],
            'username',
            'appointdate',
            'appointnum',
            'paymentstate',
        ],
    ]); ?>
</div>


