<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
//$this->params['breadcrumbs'][] = $this->title;
?>
<?=Html::cssFile('@web/css/signin.css')?>
<div class="signbk">
    <div class="signin">
        <div class="signin-head"><?=Html::img('@web/images/head_120.png', ["class"=>"img-circle"])?></div>
        <form class="form-signin" role="form" method='post'>
            <input type="text" class="form-control" placeholder="用户名" required oninvalid="setCustomValidity('用户名不能为空');" autofocus />
            <input type="password" class="form-control" required oninvalid="setCustomValidity('密码不能为空');" placeholder="密码" />
            <button class="btn btn-lg btn-warning btn-block" type="submit">登录</button>
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> 记住我
            </label>
        </form>
    </div>
    <div class="signad">
    </div>
</div>
