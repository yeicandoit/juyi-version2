<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
?>
<?=Html::cssFile('@web/css/userhome.css')?>
<?=Html::cssFile('@web/css/reg.css')?>
<div class="menuInfo">
    <?php foreach($menu as $item=>$subMenu){?>
    <div class="box">
        <div class="umenu"><h5><?php echo isset($item)?$item:"";?></h5></div>
        <div class="cont">
            <ul class="list">
                <?php foreach($subMenu as $moreKey => $moreValue){?>
                    <li><a target="_blank"  href="<?php echo $moreValue;?>"><?php echo isset($moreKey)?$moreKey:"";?></a></li>
                <?php }?>
            </ul>
        </div>
    </div>
    <?php }?>
</div>
<!--Show user info-->
<div class="userinfo">
    <div class="info_bar"><label id="manaddr" onclick="showManaddr()" style="color: #0000aa"><b>地址管理</b></label>
        &nbsp;&nbsp;&nbsp;<label id="addaddr" onclick="showAddaddr()" style="color: #0000aa"><b>添加地址</b></label></div>
    <div class="borderbottom" id="validaddr"><strong >已保存的有效地址</strong></div>
    <div style="padding-top: 20px;">
        <?= GridView::widget([
            'id' => 'adrdetail-grid',
            'dataProvider' => $dataProvider,
            'columns' => [
                ['label'=>'收货人', 'value'=>'accept_name'],
                ['label'=>'所在地区','value'=>function($dataProvider)
                {
                    $province = ArrayHelper::map(frontend\models\ShopAreas::find()->where(['area_id'=>$dataProvider->province])->asArray()->all(),'area_id','area_name');
                    $city = ArrayHelper::map(frontend\models\ShopAreas::find()->where(['area_id'=>$dataProvider->city])->asArray()->all(),'area_id','area_name');
                    $county = ArrayHelper::map(frontend\models\ShopAreas::find()->where(['area_id'=>$dataProvider->area])->asArray()->all(),'area_id','area_name');
                    return $province[$dataProvider->province].$city[$dataProvider->city].$county[$dataProvider->area];
                }],
                ['label'=>'街道地址', 'value'=>'address'],
                ['label'=>'电话/手机', 'value'=>'mobile'],
                ['label'=>'邮编', 'value'=>'zip'],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{useraddrup}{useraddrdel}{useraddrdf}',
                    'buttons' => [
                        'useraddrup' => function ($url, $model, $key) {
                            $options = [
                                'data-pjax' => '0',
                            ];
                            return Html::a('<span class="glyphicon">修改|</span>', $url, $options);
                        },
                        'useraddrdel' => function ($url) {
                            $options = [
                                'data-confirm' => Yii::t('yii', '你确定删除此地址?'),
                                'data-pjax' => '0',
                            ];
                            return Html::a('<span class="glyphicon">删除|</span>', $url, $options);
                        },
                        'useraddrdf' => function ($url, $model) {
                            $options = [
                                'data-pjax' => '0',
                            ];
                            if($model->is_default == 0) {
                                return Html::a('<span class="glyphicon">设为默认</span>', $url, $options);
                            } else {
                                return Html::a('<span class="glyphicon">取消默认</span>', $url, $options);
                            }
                        },
                    ],

                ],
            ],
        ]); ?>
    </div>
    <?php $form = ActiveForm::begin([
        'id' => 'adrdetail-form',
        'options' => ['class'=>'form-horizontal form-adrdetail', 'style' => 'display: none'],
        'fieldConfig' => [
            'template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div><div style=\"float:left;\">{input}</div>
            <div style='padding-left: 280px;'>{hint}</div><div>{error}</div>",
        ],
    ]); ?>
    <?= $form->field($useraddr, 'acceptName', [
    ])->textInput([
    ])->label('* 收货人姓名:')->hint('收货人真实姓名，方便快递公司联系。', ['style'=>'padding-left:30px',]) ?>
    <div style="float:left; margin: 0 auto;width: 280px;">
        <?=$form->field($useraddr, 'acceptProvince', [ 'template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div>
        <div style=\"float:left; margin: 0 auto;\">{input}</div>", ]
        )->dropDownList(ArrayHelper::map(frontend\models\ShopAreas::find()->where(['parent_id'=>0])->asArray()->all(),'area_id','area_name'),
            [
                'style'=>'width:180px',
                'prompt'=>'请选择省',
                'onchange'=>'$.post("index.php?r=site/areas&id='.'"+$(this).val(),function(data){
                 $("#userdetailform-acceptcity").html("<option value=0>请选择市</option>");
                 $("#userdetailform-acceptcountry").html("<option value=0>请选择县</option>");
                 $("#userdetailform-acceptcity").append(data);
            });',
            ])->label('* 所在地区:'); ?>
    </div>
    <div style="float:left; margin: 0 auto;width: 165px;">
        <?=$form->field($useraddr, 'acceptCity', [ 'template' => "{input}", ])->dropDownList([],
            [
                'style'=>'width:180px',
                'prompt'=>'请选择市',
                'onchange'=>'$.get("/index.php?r=site/areas&id='.'"+$(this).val(),function(data){
                $("#userdetailform-acceptcountry").html("<option value=0>请选择县</option>");
                $("#userdetailform-acceptcountry").append(data);});',
            ]); ?>
    </div>
    <?=$form->field($useraddr, 'acceptCountry', [ 'template' => "{input}", ])->dropDownList([],
        [
            'style'=>'width:180px',
            'prompt'=>'请选择县',
        ]); ?>
    <?= $form->field($useraddr, 'acceptDetailAddr', [
    ])->textInput([
    ])->label('* 街道地区：')->hint('真实详细收货地址，方便快递公司联系。', ['style'=>'padding-left:30px',]) ?>
    <?= $form->field($useraddr, 'acceptZip', [
    ])->textInput([
    ])->label('邮政编码：')->hint('邮政编码,如250000。', ['style'=>'padding-left:30px',]) ?>
    <?= $form->field($useraddr, 'acceptTelephone', [
    ])->textInput([
    ])->label('电话号码：')->hint('电话号码,如010-12345688。', ['style'=>'padding-left:30px',]) ?>
    <?= $form->field($useraddr, 'acceptMobile', [
    ])->textInput()->label('手机号码：')->hint('手机号码，如：13588888888', ['style'=>'padding-left:30px',]) ?>
    <?= $form->field($useraddr, 'acceptIsDefault')->checkbox()->label('设为默认') ?>
    <?= Html::submitButton('保存', [ 'style' => 'width:50px']) ?>
    <?= Html::resetButton('取消', [ 'style' => 'width:50px']) ?>
    <?php ActiveForm::end(); ?>
</div>

<script language="javascript">
    function showManaddr()
    {
        $("#validaddr").show();
        $("#adrdetail-grid").show();
        $("#adrdetail-form").hide();
    }

    function showAddaddr()
    {
        $("#validaddr").hide();
        $("#adrdetail-grid").hide();
        $("#adrdetail-form").show();
    }
</script>

