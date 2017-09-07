<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\ActiveForm;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<!--Show seller info-->
<style type="text/css">
    .form .radio{
        width:30px;
        float:left;
    }
    .form .radio label{
        display:inline;
    }
</style>
<div class="sellerinfo">
    <div class="info_bar"><b>添加广告位</b></div>
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
    <?= $form->field($adPos, 'name')->textInput()?>
    <?= $form->field($adPos, 'width')->textInput()?>
    <?= $form->field($adPos, 'height')->textInput()?>
    <?= $form->field($adPos, 'fashion')->radioList([1 => '轮显', 0 => '随即'])->label('显示方式')?>
    <?= $form->field($adPos, 'status')->radioList([1 => '开启', 0 => '关闭'])->label('状态')?>
    <?= Html::submitButton('确定', [ 'style' => 'width:50px', 'class'=>'btn btn-primary']) ?>
    <?= Html::resetButton('重置', [ 'style' => 'width:50px', 'class'=>'btn btn-primary']) ?>
    <?php ActiveForm::end(); ?>
</div>

