<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<!--Show seller info-->
<div class="sellerinfo">
    <div class="info_bar">
        <b>品牌信息</b>
    </div>
    <div class="blank"></div>
    <?php $form = ActiveForm::begin([
        'options' => ['class'=>'form-horizontal form-userinfo'],
        'fieldConfig' => [
            'template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div><div style=\"float:left;\">{input}</div>
            <div style='float: left; width: auto;'>{hint}</div><div>{error}</div>",
        ],
    ]); ?>

    <?= $form->field($brand, 'id', ['options'=>['style'=>"display:none"]])?>
    <?= $form->field($brand, 'name')->textInput()?>
    <?= $form->field($brand, 'type')->dropDownList(\backend\models\seller\Brand::getTypetextArr())?>

    <?= Html::submitButton('确定', [ 'style' => 'width:50px', 'class'=>'btn btn-primary']) ?>
    <?= Html::resetButton('重置', [ 'style' => 'width:50px', 'class'=>'btn btn-primary']) ?>
    <?php ActiveForm::end(); ?>
</div>


