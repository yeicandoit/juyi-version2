<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
?>
<?=Html::cssFile('@web/css/reg.css')?>

<div id="signup-box" class="widget-box no-border">
    <?php $form = ActiveForm::begin([
        'id' => 'expertreg',
        'options' => ['class'=>'form-horizontal form-signin',],
        'fieldConfig' => [
            'template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div><div style=\"float:left;\">{input}</div>
            <div style='float: left;height: 40px; width: 500px;'>{hint}</div><div style='padding-left: 100px;'>{error}</div>",
        ],
    ]); ?>

    <?= $form->field($model, 'regType',[])->dropDownList(
        [ 'expertreg'=>'专家入驻', 'shopreg'=>'商家入驻'],
        ['onchange'=>'jumpUrl()']
    )->label("选择入驻类型:"); ?>
    <?= $form->field($model, 'username', [
    ])->textInput([
        'id'=>'username',
        'options' => ['class'=>'form-control'],
    ])->label('用户名:')->hint('* 用户名称（必填）', ['style'=>'padding-left:30px',]) ?>
    <?= $form->field($model, 'realname', [
    ])->textInput([
        'id'=>'realname',
        'options' => ['class'=>'form-control'],
    ])->label('专家真实姓名:')->hint('* 专家真实姓名（必填）', ['style'=>'padding-left:30px',]) ?>
    <?= $form->field($model, 'password')->passwordInput([
        'id'=>'password',
        'options' => ['class'=>'form-control'],
    ])->label('密码:')->hint('* 登录密码', ['style'=>'padding-left:30px',]) ?>
    <?= $form->field($model, 'confirmpwd')->passwordInput([
        'id'=>'confirmpwd',
        'options' => ['class'=>'form-control'],
    ])->label('确认密码:')->hint('* 重复确认密码', ['style'=>'padding-left:30px',]) ?>
    <?= $form->field($model, 'phoneNumber')->textInput([
        'options' => ['class'=>'form-control'],
    ])->label('手机号码:')->hint('* 移动电话联系方式：如：13000000000', ['style'=>'padding-left:30px',]) ?>
    <?= $form->field($model, 'email')->textInput([
        'options' => ['class'=>'form-control'],
    ])->label('邮箱:')->hint('* 电子邮箱联系方式', ['style'=>'padding-left:30px',]) ?>
    <div style="float:left; margin: 0 auto;">
    <?=$form->field($model, 'province', [ 'template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div>
        <div style=\"float:left; margin: 0 auto; width: 230px;\">{input}</div>", ]
    )->dropDownList(ArrayHelper::map(frontend\models\ShopAreas::find()->where(['parent_id'=>0])->asArray()->all(),'area_id','area_name'),
        [
            'style'=>'width:200px',
            'prompt'=>'请选择省',
            'onchange'=>'$.post("index.php?r=site/areas&id='.'"+$(this).val(),function(data){
                 $("#expertregform-city").html("<option value=0>请选择市</option>");
                 $("#expertregform-area").html("<option value=0>请选择县</option>");
                 $("#expertregform-city").append(data);
            });',
        ])->label('地区:'); ?>
    </div>
    <div style="float:left; margin: 0 auto;width: 185px;">
        <?=$form->field($model, 'city', [ 'template' => "{input}", ])->dropDownList([],
            [
                'style'=>'width:200px',
                'prompt'=>'请选择市',
                'onchange'=>'$.get("/index.php?r=site/areas&id='.'"+$(this).val(),function(data){
                 $("#expertregform-area").html("<option value=0>请选择县</option>");
                 $("#expertregform-area").append(data);
            });',
            ]); ?>
    </div>
    <?=$form->field($model, 'area', [ 'template' => "{input}", ])->dropDownList([],
        [
            'style'=>'width:200px',
            'prompt'=>'请选择县',
        ]); ?>
    <?= $form->field($model, 'detailAddress')->textInput([
        'options' => ['class'=>'form-control'],
    ])->label('详细地址:') ?>
    <?= $form->field($model, 'comWeb')->textInput([
        'options' => ['class'=>'form-control'],
    ])->label('个人主页:')->hint('*填写完整的网址：如http://www.site.com', ['style'=>'padding-left:30px',]) ?>
    <?= $form->field($model,'verifyCode')->widget(yii\captcha\Captcha::className()
        ,[ 'imageOptions' =>['alt'=>'点击换图','title'=>'点击换图', 'style'=>'cursor:pointer'], 'options' => ['style'=>'float:left']])->label('验证码');?>
    <?= Html::submitButton('提交', ['class' => 'btn btn-lg btn-warning btn-block', 'name' => 'login-button', 'style' => 'width:250px']) ?>
    <?php ActiveForm::end(); ?>
</div>

<script type="text/javascript">
    function jumpUrl(){
        location.href = '/index.php?r=site/' + $("#expertregform-regtype").val();
    };
</script>
