<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\admin\AdPosition;
use dosamigos\datepicker\DatePicker;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<!--Show seller info-->
<div class="sellerinfo">
    <div class="info_bar"><b>添加广告</b></div>
    <div class="blank"></div>
    <?php if(isset($info)){?>
        <div style="height:60px;color:red;text-align:center"> <?= Html::encode($info)?> </div>
    <?php }?>
    <?php $form = ActiveForm::begin([
        'options' => ['class'=>'form-signin, form-horizontal', 'style'=>'padding-left: 20px;'],
        'fieldConfig' => [
            'template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div><div style=\"float:left;\">{input}</div>
            <div style='padding-left: 280px;'>{hint}</div><div style='padding-left: 300px;'>{error}</div>",
        ],
    ]); ?>
    <?php $option = [
        'clientOptions' => [
            'imageManagerJson' => ['/redactor/upload/image-json'],
            'imageUpload' => ['/redactor/upload/image'],
            'fileUpload' => ['/redactor/upload/file'],
            'lang' => 'zh_cn',
            'plugins' => ['clips', 'fontcolor','imagemanager']
        ]
    ];?>
    <?= $form->field($ad, 'name')->textInput()?>
    <?= $form->field($ad, 'type')->dropDownList($ad->getTypes(), ['prompt'=>'请选择'])->label('广告类型')?>
    <?= $form->field($ad, 'position_id')->dropDownList(
        ArrayHelper::map(AdPosition::find()->asArray()->all(),'id','name'), ['prompt'=>'请选择'])->label('广告位置')?>
    <?= $form->field($ad, 'link')->textInput()?>
    <?= $form->field($ad, 'order')->dropDownList(array(1=>1, 2=>2, 3=>3, 4=>4, 5=>5), ['value'=>'3'])?>
    <?= $form->field($ad, 'start_time')->widget(
        DatePicker::className(), [
        'language' => 'zh-CN',
        'addon' => false,
        // modify template for custom rendering
        'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        //	'template' => '{input}',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
            'pickButtonIcon' => 'glyphicon glyphicon-time',
        ]
    ])->label("开始日期")?>
    <?= $form->field($ad, 'end_time')->widget(
        DatePicker::className(), [
        'language' => 'zh-CN',
        'addon' => false,
        // modify template for custom rendering
        'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        //	'template' => '{input}',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
            'pickButtonIcon' => 'glyphicon glyphicon-time',
        ]
    ])->label("结束日期")?>
    <?= $form->field($ad, 'content')->widget(\yii\redactor\widgets\Redactor::className(), $option)->label('广告内容')?>
    <?= $form->field($ad, 'description')->textarea(['style'=>'width:300px'])?>
    <?= Html::submitButton('确定', [ 'style' => 'width:50px', 'class'=>'btn btn-primary']) ?>
    <?= Html::resetButton('重置', [ 'style' => 'width:50px', 'class'=>'btn btn-primary']) ?>
    <?php ActiveForm::end(); ?>
</div>

