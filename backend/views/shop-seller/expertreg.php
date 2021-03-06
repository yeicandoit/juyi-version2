<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
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

    <?= $form->field($model, 'regType',['template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div><div style=\"float:left;\">{input}</div>
         <div style='float: left;height: 100px; width: 500px;'>{hint}</div><div style='padding-left: 100px;'>{error}</div>",])->dropDownList(
        [ 'expert'=>'专家解码', 'seller'=>'检测中心', 'research'=>'科研辅助', 'simulate'=>'数值模拟'],
        ['onchange'=>'jumpUrl()']
    )->label("选择入驻类型:")->hint('检测中心：从事科研检测，分析测试，提供测试服务和提供仪器共享的请选择；<br>
                                     专家解码：硕士，博士或者科研人员可提供技术服务的请选择；<br>
                                     科研辅助：从事试验台加工，仪器维修，仪器租赁，科研仪器及耗材销售，抗体及合成中间体销售等，为服务于科研的请选择；<br>
                                     数值模拟：从事仿真计算，仿真模拟，数值模拟等方面的人才请选择；
                                    ', ['style'=>'padding-left:30px',]); ?>
    <br>
    <?= $form->field($model, 'name', [])->textInput()
        ->label('用户名:')->hint('* 用户名称(必填)，字母和数字组合，如dayang或dayang88', ['style'=>'padding-left:30px',]) ?>
    <?= $form->field($model, 'trueName', [])->textInput()
        ->label('专家真实姓名:')->hint('* 专家真实姓名（必填）', ['style'=>'padding-left:30px',]) ?>
    <?= $form->field($model, 'password')->passwordInput()
        ->label('密码:')->hint('* 登录密码', ['style'=>'padding-left:30px',]) ?>
    <?= $form->field($model, 'confirmPwd')->passwordInput()
        ->label('确认密码:')->hint('* 重复确认密码', ['style'=>'padding-left:30px',]) ?>
    <?= $form->field($model, 'mobile')->textInput()
        ->label('手机号码:')->hint('* 移动电话联系方式：如：13000000000', ['style'=>'padding-left:30px',]) ?>
    <?= $form->field($model, 'serverNum')->textInput()->label('QQ号码')?>
    <?= $form->field($model, 'email')->textInput()
        ->label('邮箱:')->hint('* 电子邮箱联系方式', ['style'=>'padding-left:30px',]) ?>
    <div style="float:left; margin: 0 auto;">
    <?=$form->field($model, 'province', [ 'template' => "<div style=\"float:left; width:100px; margin: 0 auto;\">{label}</div>
        <div style=\"float:left; margin: 0 auto; width: 230px;\">{input}{error}</div>", ]
    )->dropDownList(ArrayHelper::map(backend\models\seller\Areas::find()->where(['parent_id'=>0])->asArray()->all(),'area_id','area_name'),
        [
            'style'=>'width:200px',
            'prompt'=>'请选择省',
            'onchange'=>'setCityOption()',
        ])->label('地区:'); ?>
    </div>
    <div style="float:left; margin: 0 auto;width: 185px;">
        <?=$form->field($model, 'city', [ 'template' => "{input}{error}", ])->dropDownList([],
            [
                'style'=>'width:200px',
                'prompt'=>'请选择市',
                'onchange'=>'setAreaOption()',
            ]); ?>
    </div>
    <?=$form->field($model, 'area', [ 'template' => "{input}{error}", ])->dropDownList([],
        [
            'style'=>'width:200px',
            'prompt'=>'请选择县',
        ]); ?>
    <?= $form->field($model, 'address')->textInput()->label('详细地址:') ?>
    <?= $form->field($model,'verifyCode')->widget(yii\captcha\Captcha::className()
        ,[ 'imageOptions' =>['alt'=>'点击换图','title'=>'点击换图', 'style'=>'cursor:pointer'], 'options' => ['style'=>'float:left']])->label('验证码');?>
    <?= Html::submitButton('提交', ['class' => 'btn btn-lg btn-warning btn-block', 'name' => 'login-button', 'style' => 'width:250px']) ?>
    <?php ActiveForm::end(); ?>
</div>

<script type="text/javascript">
    function jumpUrl(){
        location.href = "<?=Url::to(['shop-seller/'])?>/sellerreg?regtype=" + $("#expertregform-regtype").val();
    };

    <?php $url = Url::to(['shop-seller/areas']); ?>
    function setCityOption()
    {
        $.get("<?= $url?>?id="+$("#expertregform-province").val(),function(data){
            $("#expertregform-city").html("<option value=0>请选择市</option>");
            $("#expertregform-area").html("<option value=0>请选择县</option>");
            $("#expertregform-city").append(data);
        });
    }

    function setAreaOption()
    {
        $.get("<?= $url?>?id="+$("#expertregform-city").val(),function(data){
            $("#expertregform-area").html("<option value=0>请选择县</option>");
            $("#expertregform-area").append(data);});
    }
</script>
