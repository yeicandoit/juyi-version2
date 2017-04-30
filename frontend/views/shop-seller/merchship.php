<?php
use yii\helpers\Html;
use yii\grid\GridView;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<!--Show seller info-->
<div class="sellerinfo">
    <div class="info_bar">
        <b>发货地址列表</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="/index.php?r=shop-seller/shipinfo"><b>添加地址</b></a>
    </div>
    <div class="blank"></div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'ship_name',
            'address',
            'postcode',
            'mobile',
            'ship_user_name',
            [
                'label'=>'默认',
                'format'=>'raw',
                'value'=>function($model) {
                    $url = "/index.php?r=shop-seller/shipdef&id=$model->id";
                    if(0 == $model->is_default){
                        return Html::a('设为默认', $url);
                    } else {
                        return Html::a('取消默认', $url);
                    }

                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{shipview} {shipdel}',
                'buttons' => [
                    'shipview' => function ($url, $model, $key) {
                        $options = [
                            'title' => Yii::t('yii', 'View'),
                            'aria-label' => Yii::t('yii', 'View'),
                            'data-pjax' => '0',
                        ];
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, $options);
                    },
                    'shipdel' => function ($url, $model, $key) {
                        $options = [
                            'title' => Yii::t('yii', 'Delete'),
                            'aria-label' => Yii::t('yii', 'Delete'),
                            'data-confirm' => Yii::t('yii', '你确定要删除此发货地址吗?'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ];

                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, $options);
                    },
                ],
            ],
        ],
    ]); ?>

</div>

