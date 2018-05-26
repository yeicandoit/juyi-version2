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
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute'=>'good_name',
                'label'=>'商品名称',
                'format'=>'raw',
                'value'=> function($model){
                    if($model->good){
                        $src = Url::to("@web/" . $model->good->img);
                    } else {
                        $src = '/images/user_ico.gif';
                    }
                    $href = Yii::$app->params['fUrl'] . "site/goodinfo&id=" . $model->good->id;
                    $name = $model->good->name;
                    $spec = isset($model->spec) ? $model->spec->specname : '';
                    return "<table>
                                   <tr>
                                   <td><a href=$href><img class='user_fav_img' src=$src /></a></td>
                                   <td>
                                    &nbsp;<a href=$href>$name</a><br>&nbsp;$spec
                                   </td>
                                   </tr>
                                </table>";
                }
            ],
            [
                'attribute'=>'user_name',
                'options' => ['width' => "100"],
                'label'=>'预约人',
                'format'=>'raw',
                'value'=> function($model){
                    return $model->user->username;
                }
            ],
            ['attribute'=>'appointdate', 'options' => ['width' => "100"]],
            ['attribute'=>'appointnum', 'options' => ['width' => "80"]],
            [
                'attribute'=>'orderstate',
                'filter'=>\backend\models\seller\Appointinfo::getCreatedOrderArr(),
                'value'=> function($model){
                    return $model->createdOrderArr[$model->orderstate];
                }
            ],
            [
                'label'=>'操作',
                'format' => 'raw',
                'value' => function($model) {
                    $yangpin = \backend\models\seller\Order::find()->where(['appointid'=>$model->appointid])->one();
                    if($yangpin){
                        return Html::a('查看样品', "http://www.juyitest.com/shop/frontend/web/index.php?r=site/test3&id=$yangpin->id");
                    } else {
                        return "";
                    }
                }
            ]

        ],
    ]); ?>
</div>


