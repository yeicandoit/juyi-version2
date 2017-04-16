<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<div class="signbk">
    <div class="signin">
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
            'placeholder'=>"用户名/邮箱",
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
    <div style="padding-left: 70px; width: 400px; float: left;">
        <p class='signin-advise'>您还不是<span style="color: orange">聚仪网</span>用户</p>
        <p>现在免费注册成为聚仪网商城用户，便能立即享受聚仪专业&周到的服务</p>
        <p><a href="/index.php?r=site/register"><strong>注册新用户</strong></a></p>
    </div>
</div>
