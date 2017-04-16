<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
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
    <div class="info_bar"><b>密码管理</b></div>
    <div class="borderbottom"><strong >修改密码</strong>
        <label style="float: right;">带<span style="color: red">*</span>号的项目为必填项</label></div>
    <?php $form = ActiveForm::begin([
        'id' => 'adrdetail-form',
        'options' => ['class'=>'form-horizontal form-chpwd'],
        'fieldConfig' => [
            'template' => "<div style=\"float:left; width:150px; margin: 0 auto;\">{label}</div><div style=\"float:left;\">{input}</div>
            <div style='padding-left: 320px;'>{hint}</div><div>{error}</div>",
        ],
    ]); ?>
    <?= $form->field($userpwd, 'oldpwd', [
    ])->passwordInput([
    ])->label('<span style="color: red">*</span> 原有密码:')->hint('原密码', ['style'=>'padding-left:30px',]) ?>
    <?= $form->field($userpwd, 'newpwd', [
    ])->passwordInput([
    ])->label('<span style="color: red">*</span> 你想要的新密码:')->hint('密码由英文字母、数字组成，长度6-32位', ['style'=>'padding-left:30px',]) ?>
    <?= $form->field($userpwd, 'cfmnewpwd', [
    ])->passwordInput([
    ])->label('<span style="color: red">*</span> 请再次输入新密码:')->hint('密码由英文字母、数字组成，长度6-32位', ['style'=>'padding-left:30px',]) ?>
    <?= Html::submitButton('修改密码', [ 'style' => 'width:80px;']) ?>
    <?= Html::resetButton('取消', [ 'style' => 'width:50px;']) ?>
    <?php ActiveForm::end(); ?>
</div>

