<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<!--Show seller info-->
<div class="sellerinfo">
    <div class="info_bar">
        <b>添加管理员</b>
    </div>
    <div class="blank"></div>
    <?php if('' != $info) {?>
        <div style="color:red;text-align:center"> <?= Html::encode($info)?> </div>
    <?php }?>
    <?php $form = ActiveForm::begin([
        'options' => ['class'=>'form-horizontal form-userinfo'],
        'fieldConfig' => [
            'template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div><div style=\"float:left;\">{input}</div>
            <div style='float: left; width: auto;'>{error}</div>",
        ],
    ]); ?>

    <?= $form->field($model, 'username')->textInput()?>
    <?= $form->field($model, 'password')->passwordInput()?>
    <?= $form->field($model, 'cfpwd')->passwordInput()?>


    <?= Html::submitButton('确定', [ 'style' => 'width:50px', 'class'=>'btn btn-primary']) ?>
    <?= Html::resetButton('重置', [ 'style' => 'width:50px', 'class'=>'btn btn-primary']) ?>
    <?php ActiveForm::end(); ?>
</div>


