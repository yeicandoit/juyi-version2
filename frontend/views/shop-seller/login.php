<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<?=Html::cssFile('@web/css/reg.css')?>
<div style="font-size:20px; color: #43478e;"><b>商家后台管理中心</b></div>
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
            'placeholder'=>"用户名/专家名",
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
