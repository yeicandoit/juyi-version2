<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<div style="font-size:20px; color: #43478e;"><b>聚仪网管理员</b></div>
<div style="border:1px groove #c4e3f3;">
        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class'=>'form-signin'],
            'fieldConfig' => [
                'template' => "{input}{error}",
            ],
        ]); ?>
        <?= $form->field($model, 'username')->textInput([
            'id'=>'username-img',
            'options' => ['class'=>'form-control'],
            'placeholder'=>"管理员",
        ]) ?>
        <?= $form->field($model, 'password')->passwordInput([
            'id'=>'password-img',
            'options' => ['class'=>'form-control'],
            'placeholder'=>"密码",
        ]) ?>
        <?= $form->field($model, 'rememberMe')->checkbox(['label' => '记住我']) ?>
        <?= Html::submitButton('登录', ['class' => 'btn btn-lg btn-warning btn-block', 'name' => 'login-button',  'style'=>'width:200px;',]) ?>
        <?php ActiveForm::end(); ?>
</div>
