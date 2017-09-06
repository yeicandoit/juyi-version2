<?php
use yii\helpers\Html;
use yii\grid\GridView;
use \yii\helpers\Url;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<!--Show seller info-->
<div class="sellerinfo">
    <div class="info_bar">
        <b>会员列表</b>
    </div>
    <div class="blank"></div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'=>$searchModel,
        'columns' => [
            [
                'label'=>'用户名',
                'options' => ['width' => "150"],
                'attribute'=>'user_name',
                'value'=>'user.username',
            ],
            //'true_name',
            [
                'label'=>'性别',
                'filter'=> array(1=>'男', 2=>'女'),
                'attribute'=>'sex',
                'value'=>function($model){
                    if(isset($model->sex)) {
                        return $model->sex == 1 ? '男' : '女';
                    }
                    return null;
                }
            ],
            'email',
            ['attribute'=>'balance','options' => ['width' => "100"],],
            ['attribute'=>'mobile','options' => ['width' => "100"],],
            ['attribute'=>'grade','options' => ['width' => "80"],
            ],
            [
                'attribute'=>'point',
                'options' => ['width' => "30"],
            ],
            [
                'label'=>'注册时间',
                'attribute'=>'created_at',
                'contentOptions' => ['style' => 'white-space: normal;', 'width' => '100'],
                'value'=>function($model){
                    return date("Y-m-d H:i:s",$model->user->created_at);
                }
            ],
            [
                'label'=>'操作',
                'format'=>'raw',
                'value'=>function($model){
                    $edit = Html::a('修改', Url::to(['admin/memberinfo', 'id'=>$model->user_id]));
                    return "$edit";
                }
            ]
        ],
    ]); ?>
</div>


