<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<!--Show seller info-->
<div class="sellerinfo">
    <div class="info_bar"><b>商家发货信息</b></div>
    <div class="blank"></div>
    <?php $form = ActiveForm::begin([
        'id' => 'adrdetail-form',
        'options' => ['class'=>'form-horizontal form-adrdetail'],
        'fieldConfig' => [
            'template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div><div style=\"float:left;\">{input}</div>
            <div style='padding-left: 280px;'>{hint}</div><div>{error}</div>",
        ],
    ]); ?>
    <?= $form->field($shipinfo, 'shipName')->textInput()->label('发货点名称 :')->hint('*发货地点名称', ['style'=>'padding-left:30px',]) ?>
    <?= $form->field($shipinfo, 'shipUserName')->textInput()->label('发货人姓名 :')->hint('*发货人姓名', ['style'=>'padding-left:30px',]) ?>
    <?= $form->field($shipinfo, 'sex')->radioList(['1'=>'男','0'=>'女'])->label('性别') ?>
    <div style="float:left; margin: 0 auto;width: 280px;">
        <?=$form->field($shipinfo, 'province', [ 'template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div>
        <div style=\"float:left; margin: 0 auto;\">{input}</div>", ]
        )->dropDownList(ArrayHelper::map(frontend\models\ShopAreas::find()->where(['parent_id'=>0])->asArray()->all(),'area_id','area_name'),
            [
                'style'=>'width:180px',
                'prompt'=>'请选择省',
                'onchange'=>'$.post("index.php?r=site/areas&id='.'"+$(this).val(),function(data){
                 $("#sellerdetailform-city").html("<option value=0>请选择市</option>");
                 $("#sellerdetailform-area").html("<option value=0>请选择县</option>");
                 $("#sellerdetailform-city").append(data);
            });',
            ])->label('地区:'); ?>
    </div>
    <div style="float:left; margin: 0 auto;width: 165px;">
        <?=$form->field($shipinfo, 'city', [ 'template' => "{input}", ])->dropDownList([],
            [
                'style'=>'width:180px',
                'prompt'=>'请选择市',
                'onchange'=>'$.get("/index.php?r=site/areas&id='.'"+$(this).val(),function(data){
                $("#sellerdetailform-area").html("<option value=0>请选择县</option>");
                $("#sellerdetailform-area").append(data);});',
            ]); ?>
    </div>
    <?=$form->field($shipinfo, 'area', [ 'template' => "{input}", ])->dropDownList([],
        [
            'style'=>'width:180px',
            'prompt'=>'请选择县',
        ]); ?>
    <?= $form->field($shipinfo, 'address', [
    ])->textInput([
    ])->label('地址：')->hint('*具体地址', ['style'=>'padding-left:30px',]) ?>
    <?= $form->field($shipinfo, 'postcode', [
    ])->textInput([
    ])->label('邮政编码：')->hint('邮政编码,如250000。', ['style'=>'padding-left:30px',]) ?>
    <?= $form->field($shipinfo, 'telphone', [
    ])->textInput([
    ])->label('电话号码：')->hint('电话号码,如010-12345688。', ['style'=>'padding-left:30px',]) ?>
    <?= $form->field($shipinfo, 'mobile', [
    ])->textInput()->label('手机号码：')->hint('手机号码，如：13588888888', ['style'=>'padding-left:30px',]) ?>
    <?= $form->field($shipinfo, 'isdefault')->checkbox()->label('设为默认') ?>
    <?= Html::submitButton('保存', [ 'style' => 'width:50px']) ?>
    <?= Html::resetButton('取消', [ 'style' => 'width:50px']) ?>
    <?php ActiveForm::end(); ?>

</div>

